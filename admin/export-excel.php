<?php
// admin/export-excel.php
require_once '../config/app.php';
require_once '../config/database.php';
require_once '../includes/auth.php';

require_role('admin');

$periode_id = $_GET['periode_id'] ?? null;
if (!$periode_id) die("Periode ID tidak diberikan.");

$stmt = $pdo->prepare("SELECT tahun_akademik FROM periode_evaluasi WHERE id = ?");
$stmt->execute([$periode_id]);
$periode = $stmt->fetchColumn();
if (!$periode) die("Periode tidak ditemukan.");

$filename = "Rekap_Evaluasi_Kurikulum_" . str_replace('/', '_', $periode) . "_" . date('Ymd_His');

// Jika PhpSpreadsheet ada, gunakan itu (format .xlsx)
if (file_exists('../vendor/autoload.php')) {
    require_once '../vendor/autoload.php';
    
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Data Mentah Jawaban');
    
    // Header
    $headers = ['ID Pengisian', 'Nama Responden', 'Email', 'Peran', 'Kategori Sasaran', 'Waktu Pengisian', 'Jenis Pertanyaan', 'Kode Matkul', 'Teks Pertanyaan', 'Nilai Skala', 'Opsi Terpilih', 'Alasan / Teks Esai'];
    $col = 'A';
    foreach ($headers as $h) {
        $sheet->setCellValue($col . '1', $h);
        $sheet->getStyle($col . '1')->getFont()->setBold(true);
        $col++;
    }
    
    // Data
    // Data
    $sql = "SELECT j.*, p.teks as pertanyaan, p.bagian, m.kode as kode_matkul, 
            COALESCE(o.teks_opsi, multi.teks_opsi_multi) as teks_opsi_final,
            pg.waktu_submit, u.nama, u.email, u.peran
            FROM jawaban j
            JOIN pertanyaan p ON j.pertanyaan_id = p.id
            LEFT JOIN mata_kuliah m ON j.mata_kuliah_id = m.id
            LEFT JOIN opsi_pertanyaan o ON j.opsi_id = o.id
            LEFT JOIN (
                SELECT jm.jawaban_id, GROUP_CONCAT(op.teks_opsi SEPARATOR ', ') as teks_opsi_multi
                FROM jawaban_multi jm
                JOIN opsi_pertanyaan op ON jm.opsi_id = op.id
                GROUP BY jm.jawaban_id
            ) multi ON j.id = multi.jawaban_id
            JOIN pengisian pg ON j.pengisian_id = pg.id
            JOIN pengguna u ON pg.pengguna_id = u.id
            WHERE pg.periode_id = ? AND pg.status = 'final'
            ORDER BY pg.waktu_submit DESC, pg.id ASC, p.bagian ASC, j.id ASC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$periode_id]);
    
    $row = 2;
    while ($d = $stmt->fetch()) {
        $sheet->setCellValue('A'.$row, $d['pengisian_id']);
        $sheet->setCellValue('B'.$row, $d['nama']);
        $sheet->setCellValue('C'.$row, $d['email']);
        $sheet->setCellValue('D'.$row, $d['peran']);
        $sheet->setCellValue('E'.$row, $d['bagian']);
        $sheet->setCellValue('F'.$row, $d['waktu_submit']);
        $sheet->setCellValue('G'.$row, $d['kode_matkul'] ? 'Mata Kuliah' : 'Kompetensi');
        $sheet->setCellValue('H'.$row, $d['kode_matkul'] ?? '-');
        $sheet->setCellValue('I'.$row, $d['pertanyaan']);
        $sheet->setCellValue('J'.$row, $d['nilai_skala'] ?? '');
        $sheet->setCellValue('K'.$row, $d['teks_opsi_final'] ?? '');
        $sheet->setCellValue('L'.$row, $d['teks'] ?? $d['alasan'] ?? '');
        $row++;
    }
    
    foreach (range('A', 'L') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
} 
else {
    // Fallback: Export to CSV natively
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="'. $filename .'.csv"');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID Pengisian', 'Nama Responden', 'Email', 'Peran', 'Kategori Sasaran', 'Waktu Pengisian', 'Jenis Pertanyaan', 'Kode Matkul', 'Teks Pertanyaan', 'Nilai Skala', 'Opsi Terpilih', 'Alasan / Teks Esai']);
    
    $sql = "SELECT j.*, p.teks as pertanyaan, p.bagian, m.kode as kode_matkul, 
            COALESCE(o.teks_opsi, multi.teks_opsi_multi) as teks_opsi_final,
            pg.waktu_submit, u.nama, u.email, u.peran
            FROM jawaban j
            JOIN pertanyaan p ON j.pertanyaan_id = p.id
            LEFT JOIN mata_kuliah m ON j.mata_kuliah_id = m.id
            LEFT JOIN opsi_pertanyaan o ON j.opsi_id = o.id
            LEFT JOIN (
                SELECT jm.jawaban_id, GROUP_CONCAT(op.teks_opsi SEPARATOR ', ') as teks_opsi_multi
                FROM jawaban_multi jm
                JOIN opsi_pertanyaan op ON jm.opsi_id = op.id
                GROUP BY jm.jawaban_id
            ) multi ON j.id = multi.jawaban_id
            JOIN pengisian pg ON j.pengisian_id = pg.id
            JOIN pengguna u ON pg.pengguna_id = u.id
            WHERE pg.periode_id = ? AND pg.status = 'final'
            ORDER BY pg.waktu_submit DESC, pg.id ASC, p.bagian ASC, j.id ASC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$periode_id]);
    
    while ($d = $stmt->fetch()) {
        fputcsv($output, [
            $d['pengisian_id'],
            $d['nama'],
            $d['email'],
            $d['peran'],
            $d['bagian'],
            $d['waktu_submit'],
            $d['kode_matkul'] ? 'Mata Kuliah' : 'Kompetensi',
            $d['kode_matkul'] ?? '-',
            $d['pertanyaan'],
            $d['nilai_skala'] ?? '',
            $d['teks_opsi_final'] ?? '',
            $d['teks'] ?? $d['alasan'] ?? ''
        ]);
    }
    
    fclose($output);
    exit;
}
?>
