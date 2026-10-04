<?php
// api/data-dashboard.php
require_once '../config/app.php';
require_once '../config/database.php';
require_once '../includes/auth.php';

header('Content-Type: application/json');

if (!is_logged_in() || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$periode_id = $_GET['periode_id'] ?? null;

// Jika periode_id tidak diberikan, gunakan periode aktif
if (!$periode_id) {
    $stmt = $pdo->query("SELECT id FROM periode_evaluasi WHERE status = 'buka' LIMIT 1");
    $periode = $stmt->fetch();
    $periode_id = $periode ? $periode['id'] : null;
}

// 1. Data Summary Cards & Breakdown
$summary = [
    'total_responden' => 0,
    'pengisian_selesai' => 0,
    'matkul_aktif' => 0,
    'role_breakdown' => ['mahasiswa' => 0, 'alumni' => 0, 'perusahaan' => 0, 'dosen' => 0]
];

$stmt = $pdo->query("SELECT COUNT(*) FROM pengguna WHERE peran != 'admin'");
$summary['total_responden'] = $stmt->fetchColumn();

if ($periode_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM pengisian WHERE periode_id = ? AND status = 'final'");
    $stmt->execute([$periode_id]);
    $summary['pengisian_selesai'] = $stmt->fetchColumn();
    
    // Breakdown
    $stmt = $pdo->prepare("SELECT u.peran, COUNT(pg.id) as cnt FROM pengisian pg JOIN pengguna u ON pg.pengguna_id = u.id WHERE pg.periode_id = ? AND pg.status = 'final' GROUP BY u.peran");
    $stmt->execute([$periode_id]);
    foreach ($stmt->fetchAll() as $r) {
        $summary['role_breakdown'][$r['peran']] = (int)$r['cnt'];
    }
} else {
    $stmt = $pdo->query("SELECT COUNT(*) FROM pengisian WHERE status = 'final'");
    $summary['pengisian_selesai'] = $stmt->fetchColumn();
}

$stmt = $pdo->query("SELECT COUNT(*) FROM mata_kuliah WHERE aktif = TRUE");
$summary['matkul_aktif'] = $stmt->fetchColumn();

// 2. Data Grafik Radar (Tren Warna Prodi - Frekuensi Pilihan B7/B8)
$radar_data = [
    'labels' => [],
    'datasets' => [
        [
            'label' => 'Alumni',
            'data' => [],
            'backgroundColor' => 'rgba(59, 130, 246, 0.2)', // Blue
            'borderColor' => 'rgba(59, 130, 246, 1)',
            'pointBackgroundColor' => 'rgba(59, 130, 246, 1)',
        ],
        [
            'label' => 'Perusahaan',
            'data' => [],
            'backgroundColor' => 'rgba(12, 161, 78, 0.2)', // Green
            'borderColor' => 'rgba(12, 161, 78, 1)',
            'pointBackgroundColor' => 'rgba(12, 161, 78, 1)',
        ]
    ]
];

$tabel_perbandingan = [];

if ($periode_id) {
    // Ambil semua kategori kompetensi agar radar chart selalu memiliki titik (minimal segi lima)
    $stmt_kategori = $pdo->query("SELECT id, nama FROM kategori_kompetensi ORDER BY id ASC");
    $kategori_all = $stmt_kategori->fetchAll();
    
    $kompetensi_map = [];
    foreach ($kategori_all as $k) {
        $nama = $k['nama'];
        $kompetensi_map[$nama] = ['alumni' => 0, 'perusahaan' => 0];
        $radar_data['labels'][] = $nama;
    }

    // Menghitung frekuensi opsi yang dipilih yang terhubung ke kategori_kompetensi
    $sql = "SELECT 
                k.id, k.nama, u.peran,
                COUNT(jm.opsi_id) as jumlah_dipilih
            FROM jawaban_multi jm
            JOIN jawaban j ON jm.jawaban_id = j.id
            JOIN opsi_pertanyaan o ON jm.opsi_id = o.id
            JOIN kategori_kompetensi k ON o.kategori_kompetensi_id = k.id
            JOIN pengisian pg ON j.pengisian_id = pg.id
            JOIN pengguna u ON pg.pengguna_id = u.id
            WHERE pg.periode_id = ? 
              AND pg.status = 'final' 
              AND u.peran IN ('alumni', 'perusahaan')
            GROUP BY k.id, k.nama, u.peran";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$periode_id]);
    $hasil_radar = $stmt->fetchAll();

    foreach ($hasil_radar as $row) {
        $nama = $row['nama'];
        if (isset($kompetensi_map[$nama])) {
            $kompetensi_map[$nama][$row['peran']] = (int)$row['jumlah_dipilih'];
        }
    }

    foreach ($radar_data['labels'] as $nama) {
        $radar_data['datasets'][0]['data'][] = $kompetensi_map[$nama]['alumni'];
        $radar_data['datasets'][1]['data'][] = $kompetensi_map[$nama]['perusahaan'];
        
        $tabel_perbandingan[] = [
            'kompetensi' => $nama,
            'rata_rata' => $kompetensi_map[$nama]['alumni'] + $kompetensi_map[$nama]['perusahaan'],
            'jumlah_respon' => '-'
        ];
    }
}

// 3. Top 5 & Bottom 5 Mata Kuliah
$matkul_ranking = ['top' => [], 'bottom' => []];
if ($periode_id) {
    // Ambil rata-rata nilai_skala untuk pertanyaan A1-A5 dari setiap matkul
    $sql_mk = "SELECT m.kode, m.nama, AVG(j.nilai_skala) as skor
               FROM jawaban j
               JOIN mata_kuliah m ON j.mata_kuliah_id = m.id
               JOIN pengisian pg ON j.pengisian_id = pg.id
               WHERE pg.periode_id = ? AND pg.status = 'final' AND j.mata_kuliah_id IS NOT NULL AND j.nilai_skala IS NOT NULL
               GROUP BY m.id
               ORDER BY skor DESC";
    $stmt = $pdo->prepare($sql_mk);
    $stmt->execute([$periode_id]);
    $all_mk = $stmt->fetchAll();
    
    if (count($all_mk) > 0) {
        $matkul_ranking['top'] = array_slice($all_mk, 0, 5);
        $bottom = array_slice($all_mk, -5);
        // Sort bottom from lowest to highest
        usort($bottom, function($a, $b) { return $a['skor'] <=> $b['skor']; });
        $matkul_ranking['bottom'] = $bottom;
    }
}

// 4. Sebaran Profil Lulusan (Alumni)
$alumni_profesi = ['labels' => [], 'data' => []];
$sql_alumni = "SELECT p.instansi, COUNT(p.pengguna_id) as cnt 
               FROM profil_pengguna p 
               JOIN pengguna u ON p.pengguna_id = u.id 
               WHERE u.peran = 'alumni' AND p.instansi IS NOT NULL 
               GROUP BY p.instansi";
$stmt = $pdo->query($sql_alumni);
foreach ($stmt->fetchAll() as $row) {
    if (trim($row['instansi']) != '') {
        $alumni_profesi['labels'][] = $row['instansi'];
        $alumni_profesi['data'][] = (int)$row['cnt'];
    }
}

// 5. Rekapitulasi Ulasan & Masukan
$ulasan = [];
if ($periode_id) {
    $sql_ulasan = "
        SELECT DATE(pg.waktu_submit) as tanggal, u.peran, m.nama as topik, j.teks, j.alasan
        FROM jawaban j
        JOIN pengisian pg ON j.pengisian_id = pg.id
        JOIN pengguna u ON pg.pengguna_id = u.id
        LEFT JOIN mata_kuliah m ON j.mata_kuliah_id = m.id
        WHERE pg.periode_id = ? AND pg.status = 'final'
          AND (j.teks IS NOT NULL OR j.alasan IS NOT NULL)
        ORDER BY pg.waktu_submit DESC
        LIMIT 50
    ";
    $stmt = $pdo->prepare($sql_ulasan);
    $stmt->execute([$periode_id]);
    $hasil_ulasan = $stmt->fetchAll();
    
    foreach ($hasil_ulasan as $u) {
        $konten = '';
        if ($u['alasan']) $konten .= "<strong>Alasan Nilai:</strong> " . $u['alasan'] . "<br>";
        if ($u['teks']) $konten .= $u['teks'];
        
        $ulasan[] = [
            'tanggal' => $u['tanggal'],
            'peran' => ucfirst($u['peran']),
            'topik' => $u['topik'] ?: 'Umum/Kompetensi',
            'isi' => $konten
        ];
    }
}

echo json_encode([
    'summary' => $summary,
    'radar' => $radar_data,
    'tabel' => $tabel_perbandingan,
    'matkul_ranking' => $matkul_ranking,
    'alumni_profesi' => $alumni_profesi,
    'ulasan' => $ulasan
]);
?>
