<?php
// seed_generator.php
$sql = "USE evaluasi_kurikulum;\n\n";
$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n";
$sql .= "TRUNCATE TABLE jawaban_multi; TRUNCATE TABLE jawaban; TRUNCATE TABLE pengisian_matkul; TRUNCATE TABLE pengisian; TRUNCATE TABLE opsi_pertanyaan; TRUNCATE TABLE pertanyaan; TRUNCATE TABLE mata_kuliah_bk; TRUNCATE TABLE mata_kuliah; TRUNCATE TABLE bahan_kajian; TRUNCATE TABLE kategori_kompetensi; TRUNCATE TABLE periode_evaluasi; TRUNCATE TABLE profil_pengguna; TRUNCATE TABLE pengguna;\n";
$sql .= "SET FOREIGN_KEY_CHECKS = 1;\n\n";

// 1. Pengguna
$sql .= "INSERT INTO pengguna (id, nama, email, password_hash, peran) VALUES\n";
$sql .= "(1, 'Administrator Prodi', 'admin@machung.ac.id', '\$2y\$10\$h412JiSNLScjfMjlAIS6beOg643fBa6Vy3EljKyZGs0R57LRsivOO', 'admin');\n\n";

$sql .= "INSERT INTO profil_pengguna (pengguna_id, nomor_induk, tahun_lulus, instansi) VALUES\n";
$sql .= "(1, 'ADM-001', NULL, 'Universitas Ma Chung');\n\n";

// ==========================================
// KOSONGAN: TANPA DATA LAIN
// ==========================================

file_put_contents('database/evaluasi_kurikulum_kosong.sql', $sql);
echo "Berhasil membuat file database/evaluasi_kurikulum_kosong.sql\n";
?>
