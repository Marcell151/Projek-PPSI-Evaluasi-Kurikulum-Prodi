<?php
// seed_generator.php
$sql = "USE evaluasi_kurikulum;\n\n";
$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n";
$sql .= "TRUNCATE TABLE jawaban_multi; TRUNCATE TABLE jawaban; TRUNCATE TABLE pengisian_matkul; TRUNCATE TABLE pengisian; TRUNCATE TABLE opsi_pertanyaan; TRUNCATE TABLE pertanyaan; TRUNCATE TABLE mata_kuliah_bk; TRUNCATE TABLE mata_kuliah; TRUNCATE TABLE bahan_kajian; TRUNCATE TABLE kategori_kompetensi; TRUNCATE TABLE periode_evaluasi; TRUNCATE TABLE profil_pengguna; TRUNCATE TABLE pengguna;\n";
$sql .= "SET FOREIGN_KEY_CHECKS = 1;\n\n";

// 1. Pengguna
$sql .= "INSERT INTO pengguna (id, nama, email, password_hash, peran) VALUES\n";
$sql .= "(1, 'Administrator Prodi', 'admin@machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'admin'),\n";
// Mahasiswa
$sql .= "(2, 'Carlo Imanuel Suryahasilaga', '322310001@student.machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'mahasiswa'),\n";
$sql .= "(3, 'William Christopher Linardi', '322310020@student.machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'mahasiswa'),\n";
$sql .= "(4, 'Kurniawan Michael Bimantara', '322310013@student.machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'mahasiswa'),\n";
$sql .= "(5, 'Marcell Chandra Kenchana', '322310015@student.machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'mahasiswa'),\n";
// Dosen
$sql .= "(6, 'Daniel Saputra', 'daniel.saputra@machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'dosen'),\n";
$sql .= "(7, 'Budi Santoso', 'budi.santoso@machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'dosen'),\n";
$sql .= "(8, 'Siti Aminah', 'siti.aminah@machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'dosen'),\n";
$sql .= "(9, 'Rina Wijaya', 'rina.wijaya@machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'dosen'),\n";
// Alumni
$sql .= "(10, 'Andi Gunawan', 'andi.alumni@gmail.com', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'alumni'),\n";
$sql .= "(11, 'Reza Pratama', 'reza.alumni@yahoo.com', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'alumni'),\n";
$sql .= "(12, 'Maya Sari', 'maya.alumni@hotmail.com', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'alumni'),\n";
$sql .= "(13, 'Kevin Sanjaya', 'kevin.alumni@gmail.com', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'alumni'),\n";
// Perusahaan
$sql .= "(14, 'HRD PT Teknologi Maju', 'hrd@tekmaju.com', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'perusahaan'),\n";
$sql .= "(15, 'Recruiter Tokopedia', 'recruiter@tokopedia.com', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'perusahaan'),\n";
$sql .= "(16, 'Talent Gojek', 'talent@gojek.com', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'perusahaan'),\n";
$sql .= "(17, 'HR Bank BCA', 'hr@bca.co.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'perusahaan');\n\n";

$sql .= "INSERT INTO profil_pengguna (pengguna_id, nomor_induk, tahun_lulus, instansi) VALUES\n";
$sql .= "(1, 'ADM-001', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(2, '322310001', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(3, '322310020', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(4, '322310013', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(5, '322310015', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(6, '0712038401', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(7, '0712038402', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(8, '0712038403', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(9, '0712038404', NULL, 'Universitas Ma Chung'),\n";
$sql .= "(10, NULL, 2021, 'PT Teknologi Maju'),\n";
$sql .= "(11, NULL, 2022, 'Tokopedia'),\n";
$sql .= "(12, NULL, 2020, 'Gojek'),\n";
$sql .= "(13, NULL, 2023, 'Bank BCA'),\n";
$sql .= "(14, NULL, NULL, 'PT Teknologi Maju'),\n";
$sql .= "(15, NULL, NULL, 'Tokopedia'),\n";
$sql .= "(16, NULL, NULL, 'Gojek'),\n";
$sql .= "(17, NULL, NULL, 'Bank BCA');\n\n";

$sql .= "INSERT INTO periode_evaluasi (id, tahun_akademik, status) VALUES\n";
$sql .= "(1, '2024/2025 Genap', 'tutup'),\n";
$sql .= "(2, '2025/2026 Ganjil', 'buka');\n\n";

// 2. Kategori Kompetensi
$kategori = [
    1 => ['K1 Data, Analitik & Kecerdasan Buatan', 'Pengelolaan data, analitik bisnis, data science, dan kecerdasan buatan.'],
    2 => ['K2 Enterprise Systems & Transformasi Bisnis', 'Sistem ERP, arsitektur enterprise, e-bisnis, dan inovasi digital.'],
    3 => ['K3 Rekayasa Perangkat Lunak & Pengembangan Aplikasi', 'Analisis kebutuhan, perancangan, pemrograman, pengujian, dan antarmuka pengguna.'],
    4 => ['K4 Infrastruktur, Jaringan & Keamanan Siber', 'Infrastruktur TI, jaringan, dan keamanan sistem.'],
    5 => ['K5 Manajemen Proyek, Tata Kelola & Audit TI', 'Manajemen proyek, strategi, risiko, layanan, dan audit TI.']
];
$sql .= "INSERT INTO kategori_kompetensi (id, nama, deskripsi) VALUES\n";
$k_values = [];
foreach ($kategori as $id => $k) {
    $k_values[] = "($id, '" . addslashes($k[0]) . "', '" . addslashes($k[1]) . "')";
}
$sql .= implode(",\n", $k_values) . ";\n\n";

// 3. Bahan Kajian
$bk = [
    'BK01' => ['Dasar-dasar Sistem Informasi', 'Foundation of Information Systems', 'NULL'],
    'BK02' => ['Manajemen Data dan Informasi', 'Data / Information Management', 1],
    'BK03' => ['Infrastruktur TI', 'IT Infrastructure', 4],
    'BK04' => ['Manajemen Proyek SI', 'IS Project Management', 5],
    'BK05' => ['Analisis dan Perancangan Sistem', 'Systems Analysis & Design', 3],
    'BK06' => ['Manajemen dan Strategi SI', 'IS Management and Strategy', 5],
    'BK07' => ['Pengembangan Aplikasi / Pemrograman', 'Application Development / Programming', 3],
    'BK08' => ['Keamanan Komputasi', 'Secure Computing', 4],
    'BK09' => ['Etika, Penggunaan, dan Dampak bagi Masyarakat', 'Ethics, use and implications for society', 'NULL'],
    'BK10' => ['Praktikum', 'Praktikum', 'NULL'],
    'BK11' => ['Matematika dan Statistika', 'Mathematics and statistics', 1],
    'BK12' => ['Analitik Data / Bisnis', 'Data / Business Analytics', 1],
    'BK13' => ['Arsitektur Enterprise', 'Enterprise Architecture', 2],
    'BK14' => ['Perancangan Antarmuka Pengguna', 'User Interface Design', 3],
    'BK15' => ['Inovasi Digital', 'Digital Innovation', 2]
];
$sql .= "INSERT INTO bahan_kajian (id, kode, nama_id, nama_en, kategori_kompetensi_id) VALUES\n";
$bk_values = [];
$bk_map = [];
$bk_id = 1;
foreach ($bk as $kode => $b) {
    $bk_map[$kode] = $bk_id;
    $bk_values[] = "($bk_id, '$kode', '" . addslashes($b[0]) . "', '" . addslashes($b[1]) . "', " . $b[2] . ")";
    $bk_id++;
}
$sql .= implode(",\n", $bk_values) . ";\n\n";

// 4. Mata Kuliah & Pemetaan BK
$matkul = [
    'SSI1140' => ['Konsep dan Pengantar SI/TI', 3, 1, 'wajib', 'prodi', ['BK01']],
    'SSI1141' => ['Antar Muka dan Pengalaman Pengguna', 3, 1, 'wajib', 'prodi', ['BK14']],
    'SSI1142' => ['Konsep Basis Data', 3, 1, 'wajib', 'prodi', ['BK02']],
    'SSI1143' => ['Matematika Diskrit', 3, 1, 'wajib', 'prodi', ['BK11']],
    'SSI1144' => ['Algoritma dan Pengantar Pemrograman', 2, 1, 'wajib', 'prodi', ['BK07']],
    'SSI1145' => ['Praktikum Algoritma dan Pengantar Pemrograman', 1, 1, 'wajib', 'prodi', ['BK10']],
    'SSI1146' => ['Desain dan Manajemen Proses Bisnis', 3, 1, 'wajib', 'prodi', ['BK05']],
    'SSI1240' => ['Bahasa Pemrograman', 2, 2, 'wajib', 'prodi', ['BK07']],
    'SSI1241' => ['Praktikum Bahasa Pemrograman', 1, 2, 'wajib', 'prodi', ['BK10']],
    'SSI1242' => ['Sistem dan Administrasi Basis Data', 3, 2, 'wajib', 'prodi', ['BK02']],
    'SSI1243' => ['Analisa dan Kebutuhan Perangkat Lunak', 3, 2, 'wajib', 'prodi', ['BK05']],
    'SSI1244' => ['Manajemen dan Proses TI', 3, 2, 'wajib', 'prodi', ['BK06']],
    'SSI1245' => ['Pengantar Akuntansi dan Keuangan', 3, 2, 'wajib', 'prodi', ['BK09']],
    'SSI2140' => ['Statistika dan Probabilitas', 2, 3, 'wajib', 'prodi', ['BK11']],
    'SSI2141' => ['Praktikum Statistika dan Probabilitas', 1, 3, 'wajib', 'prodi', ['BK10']],
    'SSI2142' => ['Arsitektur Enterprise', 3, 3, 'wajib', 'prodi', ['BK13']],
    'SSI2143' => ['Enterprise System', 5, 3, 'wajib', 'prodi', ['BK13']],
    'SSI2144' => ['Desain dan Deskripsi Perangkat Lunak', 3, 3, 'wajib', 'prodi', ['BK05']],
    'SSI2145' => ['Perencanaan Strategis SI/TI', 3, 3, 'wajib', 'prodi', ['BK06']],
    'SSI2146' => ['E-Bisnis', 3, 3, 'wajib', 'prodi', ['BK15']],
    'SSI2240' => ['Manajemen Proyek Sistem Informasi', 3, 4, 'wajib', 'prodi', ['BK04']],
    'SSI2241' => ['Sistem Informasi Manajemen', 3, 4, 'wajib', 'prodi', ['BK06']],
    'SSI2242' => ['Manajemen Resiko SI/TI', 3, 4, 'wajib', 'prodi', ['BK06']],
    'SSI2243' => ['Keamanan Sistem Informasi', 3, 4, 'wajib', 'prodi', ['BK08']],
    'SSI2244' => ['Kecerdasan Bisnis', 3, 4, 'wajib', 'prodi', ['BK12']],
    'SSI2245' => ['Manajemen Layanan Teknologi Informasi', 3, 4, 'wajib', 'prodi', ['BK06']],
    'SSI2246' => ['Manajemen & Organisasi', 2, 4, 'wajib', 'prodi', ['BK09']],
    'SSI3140' => ['Pemrograman Bergerak', 2, 5, 'wajib', 'prodi', ['BK07']],
    'SSI3141' => ['Praktikum Pemrograman Bergerak', 1, 5, 'wajib', 'prodi', ['BK10']],
    'SSI3142' => ['Transformasi Digital', 2, 5, 'wajib', 'prodi', ['BK06']],
    'SSI3143' => ['Testing dan Dokumentasi Perangkat Lunak', 3, 5, 'wajib', 'prodi', ['BK05']],
    'SSI3144' => ['Audit SI/TI', 3, 5, 'wajib', 'prodi', ['BK06']],
    'SSI3145' => ['Metodologi Penelitian dan Penulisan Ilmiah', 2, 5, 'wajib', 'prodi', ['BK10']],
    'SSI3146' => ['Teknologi Keuangan', 3, 5, 'wajib', 'prodi', ['BK15']],
    'SSI3240' => ['Desain dan Keamanan Jaringan', 3, 6, 'wajib', 'prodi', ['BK03(U)', 'BK08']],
    'SSI3241' => ['Komunikasi dan Negosiasi', 2, 6, 'wajib', 'prodi', ['BK09']],
    'SSI3244' => ['Manajemen Data', 3, 6, 'wajib', 'prodi', ['BK02']],
    'SSI3242' => ['Etika Profesi dan Profesional', 2, 6, 'wajib', 'prodi', ['BK09']],
    'SSI3245' => ['Pengukuran dan Kualitas Perangkat Lunak', 3, 6, 'wajib', 'prodi', ['BK05']],
    'SSI4140' => ['Proyek Pengembangan Sistem Informasi', 3, 7, 'wajib', 'prodi', ['BK04']],
    'SSI4141' => ['Kerja Praktek / Magang', 3, 7, 'wajib', 'prodi', ['BK10']],
    'SSI4143' => ['Technopreneurship', 3, 7, 'wajib', 'prodi', ['BK15']],
    'SSI4144' => ['Sistem Informasi Akuntansi', 3, 7, 'wajib', 'prodi', ['BK10']],
    'SSI4240' => ['Tugas Akhir / Skripsi', 6, 8, 'wajib', 'prodi', ['BK10']],
    'SSI5130' => ['Sistem Informasi Geografis', 3, 7, 'pilihan', 'prodi', ['BK02']],
    'SSI5131' => ['Kualitas Data', 3, 7, 'pilihan', 'prodi', ['BK07']],
    'SSI5132' => ['Sistem Informasi Manufaktur', 3, 7, 'pilihan', 'prodi', ['BK09']],
    'MPK403' => ['Bahasa Inggris 1', 1, 1, 'wajib', 'universitas', []],
    'MPK404' => ['Bahasa Inggris 2', 1, 2, 'wajib', 'universitas', []]
];
$sql .= "INSERT INTO mata_kuliah (id, kode, nama, sks, semester, jenis, kelompok, aktif) VALUES\n";
$mk_values = [];
$mk_bk_values = [];
$mk_id = 1;
foreach ($matkul as $kode => $m) {
    $mk_values[] = "($mk_id, '$kode', '" . addslashes($m[0]) . "', {$m[1]}, {$m[2]}, '{$m[3]}', '{$m[4]}', 1)";
    foreach ($m[5] as $bkk) {
        $utama = 0;
        if (strpos($bkk, '(U)') !== false) {
            $utama = 1;
            $bkk = str_replace('(U)', '', $bkk);
        }
        $b_id = $bk_map[$bkk];
        $mk_bk_values[] = "($mk_id, $b_id, $utama)";
    }
    $mk_id++;
}
$sql .= implode(",\n", $mk_values) . ";\n\n";

if (count($mk_bk_values) > 0) {
    $sql .= "INSERT INTO mata_kuliah_bk (mata_kuliah_id, bahan_kajian_id, utama) VALUES\n";
    $sql .= implode(",\n", $mk_bk_values) . ";\n\n";
}

// Skala JSONs
$s_setuju = '["Sangat tidak setuju", "Tidak setuju", "Netral", "Setuju", "Sangat setuju"]';
$s_mudah = '["Sangat sulit", "Sulit", "Cukup", "Mudah", "Sangat mudah"]';
$s_berguna = '["Tidak berguna", "Kurang berguna", "Cukup berguna", "Berguna", "Sangat berguna"]';
$s_sesuai = '["Tidak sesuai", "Kurang sesuai", "Cukup sesuai", "Sesuai", "Sangat sesuai"]';
$s_mutakhir = '["Sangat tertinggal", "Tertinggal", "Cukup mutakhir", "Mutakhir", "Sangat mutakhir"]';
$s_relevan = '["Sangat tidak relevan", "Kurang relevan", "Cukup relevan", "Relevan", "Sangat relevan"]';
$s_puas = '["Sangat tidak puas", "Tidak puas", "Cukup puas", "Puas", "Sangat puas"]';
$s_baik = '["Sangat kurang", "Kurang", "Cukup", "Baik", "Sangat baik"]';
$s_sering = '["Tidak pernah", "Jarang", "Kadang-kadang", "Sering", "Sangat sering"]';

// Pertanyaan
$sql .= "INSERT INTO pertanyaan (id, kode, teks, bantuan, tipe, bagian, peran_sasaran, wajib, label_skala, syarat_tampil, penanda, maks_pilihan, urutan, default_aktif) VALUES\n";

$pertanyaan_data = [];
$opsi_data = [];
$p_id = 1;
$o_id = 1;

function add_p(&$pertanyaan_data, &$opsi_data, &$p_id, &$o_id, $kode, $teks, $bantuan, $tipe, $bagian, $peran, $wajib, $label_skala, $syarat, $penanda, $maks_pilihan, $urutan, $default_aktif, $opsi_list=[]) {
    $bantuan_sql = $bantuan ? "'".addslashes($bantuan)."'" : "NULL";
    $label_skala_sql = $label_skala ? "'".addslashes($label_skala)."'" : "NULL";
    $syarat_sql = $syarat ? "'".addslashes($syarat)."'" : "NULL";
    $penanda_sql = $penanda ? "'".addslashes($penanda)."'" : "NULL";
    $maks_sql = $maks_pilihan ? $maks_pilihan : "NULL";
    
    $pertanyaan_data[] = "($p_id, '$kode', '" . addslashes($teks) . "', $bantuan_sql, '$tipe', '$bagian', '$peran', $wajib, $label_skala_sql, $syarat_sql, $penanda_sql, $maks_sql, $urutan, $default_aktif)";
    
    if (count($opsi_list) > 0) {
        $urutan_o = 1;
        foreach ($opsi_list as $opsi_item) {
            $kat_id = "NULL";
            if (is_array($opsi_item)) {
                $teks_o = $opsi_item[0];
                $kat_id = $opsi_item[1];
            } else {
                $teks_o = $opsi_item;
            }
            $opsi_data[] = "($o_id, $p_id, '" . addslashes($teks_o) . "', $kat_id, $urutan_o)";
            $o_id++;
            $urutan_o++;
        }
    }
    $p_id++;
}

// BAGIAN A
// A1
foreach (['mahasiswa', 'alumni', 'perusahaan', 'dosen'] as $peran) {
    add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A1', 'Mata kuliah ini layak dipertahankan dalam kurikulum program studi.', 'Nilai 1 atau 2 memerlukan alasan.', 'skala', 'matkul', $peran, 1, $s_setuju, null, 'untuk_peringkat', null, 1, 1);
}

// Mahasiswa
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A2', 'Seberapa mudah materi mata kuliah ini untuk dipahami?', 'Nilai berdasarkan penjelasan, bahan ajar, dan tugas.', 'skala', 'matkul', 'mahasiswa', 1, $s_mudah, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A3', 'Beban materi dan tugas pada mata kuliah ini sebanding dengan bobot SKS-nya.', '', 'skala', 'matkul', 'mahasiswa', 1, $s_setuju, null, null, null, 3, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A4', 'Setelah mengikuti mata kuliah ini, saya memahami konsep dasar bidangnya.', '', 'skala', 'matkul', 'mahasiswa', 1, $s_setuju, null, null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A5', 'Mata kuliah ini membantu saya mengikuti mata kuliah lanjutan.', 'Pilih Netral bila Anda belum mengambil mata kuliah lanjutannya.', 'skala', 'matkul', 'mahasiswa', 1, $s_setuju, null, null, null, 5, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A6', 'Saran atau catatan Anda untuk mata kuliah ini.', 'Misalnya bagian yang terasa terlalu sulit atau terlalu mudah.', 'teks', 'matkul', 'mahasiswa', 0, null, null, null, null, 6, 1);

// Alumni
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A2', 'Seberapa berguna materi mata kuliah ini dalam pekerjaan Anda saat ini?', 'Nilai berdasarkan pengalaman kerja, bukan kesan saat kuliah.', 'skala', 'matkul', 'alumni', 1, $s_berguna, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A3', 'Seberapa sering Anda menggunakan materi mata kuliah ini dalam pekerjaan?', '', 'skala', 'matkul', 'alumni', 1, $s_sering, null, null, null, 3, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A4', 'Kedalaman materi mata kuliah ini cukup sebagai bekal bekerja.', '', 'skala', 'matkul', 'alumni', 1, $s_setuju, null, null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A5', 'Materi mata kuliah ini sejalan dengan praktik yang berlaku di tempat kerja Anda.', '', 'skala', 'matkul', 'alumni', 1, $s_setuju, null, null, null, 5, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A6', 'Saran atau catatan Anda untuk mata kuliah ini.', 'Misalnya materi yang perlu ditambah atau dikurangi.', 'teks', 'matkul', 'alumni', 0, null, null, null, null, 6, 1);

// Perusahaan
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A2', 'Seberapa sesuai bidang yang dicakup mata kuliah ini dengan kebutuhan kerja di perusahaan Anda saat ini?', 'Bila nama mata kuliahnya kurang dikenal, gunakan keterangan Bahan Kajian pada kartu.', 'skala', 'matkul', 'perusahaan', 1, $s_sesuai, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A3', 'Lulusan yang menguasai bidang ini lebih siap bekerja di perusahaan kami.', '', 'skala', 'matkul', 'perusahaan', 1, $s_setuju, null, null, null, 3, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A4', 'Bidang ini tetap dibutuhkan perusahaan kami dalam 3 sampai 5 tahun ke depan.', '', 'skala', 'matkul', 'perusahaan', 1, $s_setuju, null, null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A5', 'Bagaimana sebaiknya porsi bidang ini dalam kurikulum?', '', 'pilihan_ganda', 'matkul', 'perusahaan', 1, null, null, null, null, 5, 1, ['Perlu diperdalam', 'Sudah sesuai', 'Cukup sebagai pengantar', 'Tidak lagi diperlukan']);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A6', 'Keahlian terkait yang menurut Anda belum tercakup oleh mata kuliah ini.', '', 'teks', 'matkul', 'perusahaan', 0, null, null, null, null, 6, 1);

// Dosen
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A2', 'Seberapa mutakhir silabus dan materi mata kuliah ini dibandingkan kebutuhan industri saat ini?', 'Bandingkan dengan perkembangan teknologi dan praktik industri terbaru.', 'skala', 'matkul', 'dosen', 1, $s_mutakhir, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A3', 'Mata kuliah ini saat ini berbobot {sks} SKS. Bagaimana rekomendasi Anda terhadap bobot SKS dan durasinya?', 'Pertimbangkan kedalaman materi dan jam tatap muka.', 'pilihan_ganda', 'matkul', 'dosen', 1, null, null, null, null, 3, 1, ['Sudah sesuai; cukup 1 semester dengan bobot SKS saat ini', 'Bobot SKS perlu ditambah', 'Bobot SKS perlu dikurangi', 'Sebaiknya diperpanjang menjadi 2 semester (dasar dan lanjutan)']);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A4', 'Berapa usulan bobot atau pembagian semesternya, dan apa alasannya?', '', 'teks', 'matkul', 'dosen', 0, null, 'A3_BUKAN_OPSI_1', null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A5', 'Materi mata kuliah ini selaras dengan capaian pembelajaran dan mata kuliah lanjutannya.', '', 'skala', 'matkul', 'dosen', 1, $s_setuju, null, null, null, 5, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A6', 'Mahasiswa umumnya memiliki bekal awal yang cukup untuk mengikuti mata kuliah ini.', '', 'skala', 'matkul', 'dosen', 1, $s_setuju, null, null, null, 6, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'A7', 'Bab, teori, atau studi kasus yang sebaiknya diperbarui atau dihapus.', 'Boleh dikosongkan bila materi sudah sesuai.', 'teks', 'matkul', 'dosen', 0, null, null, null, null, 7, 1);

// AX1 dan AX2 (OFF)
foreach (['mahasiswa', 'alumni', 'dosen'] as $peran) {
    add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'AX1', 'Menurut Anda, posisi semester mata kuliah ini sudah tepat?', '', 'pilihan_ganda', 'matkul', $peran, 1, null, null, null, null, 90, 0, ['Sebaiknya lebih awal', 'Sudah tepat', 'Sebaiknya lebih akhir']);
}
foreach (['mahasiswa', 'alumni', 'perusahaan', 'dosen'] as $peran) {
    add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'AX2', 'Bagaimana status mata kuliah ini sebaiknya dalam kurikulum?', '', 'pilihan_ganda', 'matkul', $peran, 1, null, null, null, null, 91, 0, ['Tetap wajib', 'Dijadikan pilihan', 'Digabung dengan mata kuliah lain', 'Dihentikan']);
}

// BAGIAN B
// Mahasiswa
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B1', 'Seberapa mudah Anda beradaptasi dengan cara dan beban belajar di program studi ini?', 'Pikirkan pengalaman Anda secara keseluruhan.', 'skala', 'kompetensi', 'mahasiswa', 1, $s_mudah, null, null, null, 1, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B2', 'Urutan mata kuliah dari semester ke semester membantu saya memahami materi secara bertahap.', '', 'skala', 'kompetensi', 'mahasiswa', 1, $s_setuju, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B3', 'Kurikulum menyeimbangkan teori dan praktik dengan baik.', '', 'skala', 'kompetensi', 'mahasiswa', 1, $s_setuju, null, null, null, 3, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B4', 'Kurikulum membantu saya menyiapkan diri untuk bekerja di bidang SI/TI.', '', 'skala', 'kompetensi', 'mahasiswa', 1, $s_setuju, null, null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B5', 'Saya memahami keterkaitan antar mata kuliah di program studi ini.', '', 'skala', 'kompetensi', 'mahasiswa', 1, $s_setuju, null, null, null, 5, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B6', 'Beban belajar per semester (jumlah SKS dan tugas) masih dapat saya tangani.', '', 'skala', 'kompetensi', 'mahasiswa', 1, $s_setuju, null, null, null, 6, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B7', 'Saya percaya diri dengan kemampuan teknis yang saya peroleh sejauh ini.', '', 'skala', 'kompetensi', 'mahasiswa', 1, $s_setuju, null, null, null, 7, 1);
$opsi_k = [['K1 Data, Analitik & Kecerdasan Buatan', 1], ['K2 Enterprise Systems & Transformasi Bisnis', 2], ['K3 Rekayasa Perangkat Lunak & Pengembangan Aplikasi', 3], ['K4 Infrastruktur, Jaringan & Keamanan Siber', 4], ['K5 Manajemen Proyek, Tata Kelola & Audit TI', 5]];
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B8', 'Bidang kompetensi mana yang paling ingin Anda perdalam?', 'Pilih paling banyak 2.', 'pilihan_ganda_banyak', 'kompetensi', 'mahasiswa', 1, null, null, null, 2, 8, 1, $opsi_k);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B9', 'Mata kuliah atau topik yang menurut Anda perlu ditambahkan ke kurikulum.', '', 'teks', 'kompetensi', 'mahasiswa', 0, null, null, null, null, 9, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B10', 'Saran lain untuk kurikulum program studi.', '', 'teks', 'kompetensi', 'mahasiswa', 0, null, null, null, null, 10, 1);

// Alumni
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B1', 'Secara keseluruhan, seberapa relevan kurikulum program studi dengan tuntutan pekerjaan Anda saat ini?', 'Pikirkan seluruh bekal yang Anda dapat selama kuliah.', 'skala', 'kompetensi', 'alumni', 1, $s_relevan, null, null, null, 1, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B2', 'Bekal kemampuan teknis (hardskill) dari kampus cukup untuk memulai pekerjaan pertama saya.', '', 'skala', 'kompetensi', 'alumni', 1, $s_setuju, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B3', 'Bekal kemampuan non-teknis (softskill) dari kampus cukup untuk memulai pekerjaan pertama saya.', '', 'skala', 'kompetensi', 'alumni', 1, $s_setuju, null, null, null, 3, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B4', 'Saya dapat beradaptasi dengan cepat di lingkungan kerja berkat bekal dari kampus.', '', 'skala', 'kompetensi', 'alumni', 1, $s_setuju, null, null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B5', 'Kurikulum memberi dasar yang kuat bagi saya untuk terus mempelajari teknologi baru.', '', 'skala', 'kompetensi', 'alumni', 1, $s_setuju, null, null, null, 5, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B6', 'Kerja praktik, magang, dan proyek selama kuliah membantu kesiapan kerja saya.', '', 'skala', 'kompetensi', 'alumni', 1, $s_setuju, null, null, null, 6, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B7', 'Kelompok kompetensi apa yang paling sering Anda gunakan dalam pekerjaan?', 'Pilih paling banyak 2 yang paling dominan.', 'pilihan_ganda_banyak', 'kompetensi', 'alumni', 1, null, null, 'WARNA_PRODI', 2, 7, 1, $opsi_k);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B8', 'Materi yang dulu terasa kurang penting, tetapi ternyata berguna di dunia kerja.', 'Sebutkan materi atau mata kuliahnya.', 'teks', 'kompetensi', 'alumni', 0, null, null, null, null, 8, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B9', 'Teknologi atau materi yang menurut Anda sudah usang dan perlu diperbarui.', '', 'teks', 'kompetensi', 'alumni', 0, null, null, null, null, 9, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B10', 'Saran lain untuk kurikulum program studi.', '', 'teks', 'kompetensi', 'alumni', 0, null, null, null, null, 10, 1);

// Perusahaan
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B1', 'Seberapa puas Anda dengan kemampuan teknis (hardskill) lulusan program studi kami?', 'Nilai berdasarkan lulusan yang Anda ketahui langsung.', 'skala', 'kompetensi', 'perusahaan', 1, $s_puas, null, null, null, 1, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B2', 'Bagaimana penilaian Anda terhadap kemampuan non-teknis (softskill) lulusan kami, seperti komunikasi, inisiatif, etika, dan kerja sama tim?', '', 'skala', 'kompetensi', 'perusahaan', 1, $s_baik, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B3', 'Lulusan kami mampu beradaptasi dengan cepat di lingkungan kerja.', '', 'skala', 'kompetensi', 'perusahaan', 1, $s_setuju, null, null, null, 3, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B4', 'Lulusan kami menguasai dasar-dasar SI/TI yang dibutuhkan perusahaan.', '', 'skala', 'kompetensi', 'perusahaan', 1, $s_setuju, null, null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B5', 'Lulusan kami mampu menjembatani kebutuhan bisnis dan solusi teknologi.', '', 'skala', 'kompetensi', 'perusahaan', 1, $s_setuju, null, null, null, 5, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B6', 'Bagaimana kemampuan lulusan kami mempelajari teknologi baru di tempat kerja?', '', 'skala', 'kompetensi', 'perusahaan', 1, $s_baik, null, null, null, 6, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B7', 'Kompetensi apa yang paling Anda butuhkan dari lulusan IT dalam beberapa tahun ke depan?', 'Pilih paling banyak 2 yang paling Anda prioritaskan. Jawaban ini membentuk arah kurikulum program studi.', 'pilihan_ganda_banyak', 'kompetensi', 'perusahaan', 1, null, null, 'WARNA_PRODI', 2, 7, 1, $opsi_k);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B8', 'Kesenjangan kompetensi (skill gap) yang paling nyata pada lulusan kami saat mulai bekerja.', 'Sebutkan contoh yang Anda temui.', 'teks', 'kompetensi', 'perusahaan', 0, null, null, null, null, 8, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B9', 'Perangkat lunak, framework, atau standar yang sebaiknya diajarkan agar lulusan langsung siap pakai di perusahaan Anda.', 'Sebutkan nama spesifiknya.', 'teks', 'kompetensi', 'perusahaan', 0, null, null, null, null, 9, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B10', 'Masukan lain untuk kurikulum program studi.', '', 'teks', 'kompetensi', 'perusahaan', 0, null, null, null, null, 10, 1);

// Dosen
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B1', 'Kurikulum program studi saat ini selaras dengan perkembangan kebutuhan industri.', '', 'skala', 'kompetensi', 'dosen', 1, $s_setuju, null, null, null, 1, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B2', 'Capaian pembelajaran lulusan sudah tercermin dalam rangkaian mata kuliah.', '', 'skala', 'kompetensi', 'dosen', 1, $s_setuju, null, null, null, 2, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B3', 'Urutan mata kuliah antar semester sudah logis dan bertahap.', '', 'skala', 'kompetensi', 'dosen', 1, $s_setuju, null, null, null, 3, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B4', 'Keseimbangan antara teori dan praktik dalam kurikulum sudah baik.', '', 'skala', 'kompetensi', 'dosen', 1, $s_setuju, null, null, null, 4, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B5', 'Tidak ada tumpang tindih materi yang berarti antar mata kuliah.', '', 'skala', 'kompetensi', 'dosen', 1, $s_setuju, null, null, null, 5, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B6', 'Beban SKS per semester sudah proporsional.', '', 'skala', 'kompetensi', 'dosen', 1, $s_setuju, null, null, null, 6, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B7', 'Kurikulum memberi ruang yang cukup bagi mahasiswa untuk mendalami minat melalui mata kuliah pilihan.', '', 'skala', 'kompetensi', 'dosen', 1, $s_setuju, null, null, null, 7, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B8', 'Bidang apa yang sebaiknya diperkuat dalam kurikulum?', '', 'pilihan_ganda_banyak', 'kompetensi', 'dosen', 1, null, null, null, 2, 8, 1, $opsi_k);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B9', 'Usulan mata kuliah baru atau perubahan struktur kurikulum.', '', 'teks', 'kompetensi', 'dosen', 0, null, null, null, null, 9, 1);
add_p($pertanyaan_data, $opsi_data, $p_id, $o_id, 'B10', 'Saran lain untuk kurikulum program studi.', '', 'teks', 'kompetensi', 'dosen', 0, null, null, null, null, 10, 1);

$sql .= implode(",\n", $pertanyaan_data) . ";\n\n";

$sql .= "INSERT INTO opsi_pertanyaan (id, pertanyaan_id, teks_opsi, kategori_kompetensi_id, urutan) VALUES\n";
$sql .= implode(",\n", $opsi_data) . ";\n\n";

// ==========================================
// SEED DUMMY ISIAN KUESIONER (ANSWERS)
// ==========================================
$sql .= "-- Dummy Answers Data\n";

$pengisian = [];
$pengisian_matkul = [];
$jawaban = [];
$jawaban_multi = [];
$p_id = 1;
$j_id = 1;
$jm_id = 1;

$users = [
    2 => 'mahasiswa', 3 => 'mahasiswa', 4 => 'mahasiswa', 5 => 'mahasiswa',
    6 => 'dosen', 7 => 'dosen', 8 => 'dosen', 9 => 'dosen',
    10 => 'alumni', 11 => 'alumni', 12 => 'alumni', 13 => 'alumni',
    14 => 'perusahaan', 15 => 'perusahaan', 16 => 'perusahaan', 17 => 'perusahaan'
];

foreach ([1, 2] as $periode) {
    foreach ($users as $uid => $peran) {
        // Skip some for period 1
        if ($periode == 1 && rand(0,1) == 0) continue;
        
        $waktu = $periode == 1 ? "2025-06-0" . rand(1,9) . " 10:30:00" : "2025-10-0" . rand(1,9) . " 10:30:00";
        $pengisian[] = "($p_id, $uid, $periode, 'final', 2, '$waktu', '$waktu')";
        
        // Pick 3 random matkul for this user
        $mks = array_rand(array_flip(range(1, 47)), 3);
        if (!is_array($mks)) $mks = [$mks];
        
        foreach ($mks as $mk) {
            $pengisian_matkul[] = "($p_id, $mk)";
            
            // Pertanyaan Bagian A untuk peran ini
            $qa_list = array_filter(explode(";\n\n", implode(",\n", $pertanyaan_data)), function($v) use ($peran) {
                return strpos($v, "'matkul'") !== false && strpos($v, "'$peran'") !== false;
            });
            // Very simplified: just give random values for skala
            $sql_q = "SELECT id, tipe FROM pertanyaan WHERE bagian='matkul' AND peran_sasaran='$peran'";
            // wait, we don't have db connection here, we are generating sql.
            // Let's hardcode the question ranges based on the IDs we inserted above.
            // A1 is 1-4. Mhs A2-A6 = 5-9. Alumni A2-A6 = 10-14. Perusahaan A2-A6 = 15-19. Dosen A2-A7 = 20-25.
            
            $q_ids = [];
            if ($peran == 'mahasiswa') $q_ids = [1,5,6,7,8]; // Skala
            if ($peran == 'alumni') $q_ids = [2,10,11,12,13]; // Skala
            if ($peran == 'perusahaan') $q_ids = [3,15,16,17]; // Skala
            if ($peran == 'dosen') $q_ids = [4,20,23,24]; // Skala
            
            foreach ($q_ids as $qid) {
                $val = rand(3, 5); // Bias towards good scores
                $alasan = "NULL";
                
                // Add some dummy feedback for low scores or randomly
                if ($val == 3 && rand(0, 2) == 0) {
                    $alasan = "'Materi kurang *up-to-date* dengan kebutuhan industri saat ini.'";
                } elseif ($val == 5 && rand(0, 5) == 0) {
                    $alasan = "'Sangat baik, namun durasi praktik mungkin bisa diperbanyak.'";
                }
                
                $jawaban[] = "($j_id, $p_id, $qid, $mk, $val, NULL, NULL, $alasan)";
                $j_id++;
            }
        }
        
        // Bagian B (Kompetensi)
        $qb_ids = [];
        if ($peran == 'mahasiswa') $qb_ids = [33,34,35,36,37,38,39]; // B1-B7 Skala
        if ($peran == 'alumni') $qb_ids = [43,44,45,46,47,48]; // B1-B6 Skala
        if ($peran == 'perusahaan') $qb_ids = [53,54,55,56,57,58]; // B1-B6 Skala
        if ($peran == 'dosen') $qb_ids = [63,64,65,66,67,68,69]; // B1-B7 Skala
        
        foreach ($qb_ids as $qid) {
            $val = rand(3, 5);
            $teks = "NULL";
            
            // Randomly add some textual comments to general questions
            if (rand(0, 8) == 0) {
                $teks = "'Kompetensi ini sangat penting. Lulusan diharapkan memiliki inisiatif tinggi.'";
            }
            
            $jawaban[] = "($j_id, $p_id, $qid, NULL, $val, NULL, $teks, NULL)";
            $j_id++;
        }
        
        // Bagian B Multi (Warna Prodi)
        $qb_multi = 0;
        if ($peran == 'mahasiswa') $qb_multi = 40;
        if ($peran == 'alumni') $qb_multi = 49;
        if ($peran == 'perusahaan') $qb_multi = 59;
        if ($peran == 'dosen') $qb_multi = 70;
        
        if ($qb_multi > 0) {
            $jawaban[] = "($j_id, $p_id, $qb_multi, NULL, NULL, NULL, NULL, NULL)";
            $multi_jid = $j_id;
            $j_id++;
            
            // Opsi ID for multi are at the end: 34-53 (5 for each role)
            $start_opsi = 34;
            if ($peran == 'alumni') $start_opsi = 39;
            if ($peran == 'perusahaan') $start_opsi = 44;
            if ($peran == 'dosen') $start_opsi = 49;
            
            $picked = array_rand(range($start_opsi, $start_opsi+4), rand(1, 2));
            if (!is_array($picked)) $picked = [$picked];
            
            foreach ($picked as $p_idx) {
                $opsi_val = $start_opsi + $p_idx;
                $jawaban_multi[] = "($multi_jid, $opsi_val)";
            }
        }
        
        $p_id++;
    }
}

$sql .= "INSERT INTO pengisian (id, pengguna_id, periode_id, status, tab_terakhir, terakhir_disimpan, waktu_submit) VALUES\n";
$sql .= implode(",\n", $pengisian) . ";\n\n";

$sql .= "INSERT INTO pengisian_matkul (pengisian_id, mata_kuliah_id) VALUES\n";
$sql .= implode(",\n", $pengisian_matkul) . ";\n\n";

$sql .= "INSERT INTO jawaban (id, pengisian_id, pertanyaan_id, mata_kuliah_id, nilai_skala, opsi_id, teks, alasan) VALUES\n";
$sql .= implode(",\n", $jawaban) . ";\n\n";

if (count($jawaban_multi) > 0) {
    $sql .= "INSERT INTO jawaban_multi (jawaban_id, opsi_id) VALUES\n";
    $sql .= implode(",\n", $jawaban_multi) . ";\n\n";
}

file_put_contents('database/seed_rich.sql', $sql);
echo "Berhasil membuat file database/seed_rich.sql\n";
?>
