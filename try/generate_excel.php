<?php
$f = fopen('template_impor_mahasiswa.csv', 'w');
fputcsv($f, ['NIM', 'Nama Lengkap (Wajib)', 'Email (Wajib)']);
fclose($f);

$f = fopen('dummy_mahasiswa.csv', 'w');
fputcsv($f, ['NIM', 'Nama Lengkap (Wajib)', 'Email (Wajib)']);
fputcsv($f, ['322310001', 'Carlo Imanuel Suryahasilaga', '322310001@student.machung.ac.id']);
fputcsv($f, ['322310020', 'William Christopher Linardi', '322310020@student.machung.ac.id']);
fputcsv($f, ['322310013', 'Kurniawan Michael Bimantara', '322310013@student.machung.ac.id']);
fputcsv($f, ['322310015', 'Marcell Chandra Kenchana', '322310015@student.machung.ac.id']);
fclose($f);

$f = fopen('template_impor_dosen.csv', 'w');
fputcsv($f, ['NIDN', 'Nama Lengkap (Wajib)', 'Email (Wajib)']);
fclose($f);

$f = fopen('dummy_dosen.csv', 'w');
fputcsv($f, ['NIDN', 'Nama Lengkap (Wajib)', 'Email (Wajib)']);
fputcsv($f, ['0712038401', 'Daniel Saputra', 'daniel.saputra@machung.ac.id']);
fputcsv($f, ['0712038402', 'Marcelino Steven', 'marcelino.steven@machung.ac.id']);
fputcsv($f, ['0712038403', 'Felicia Angelina', 'felicia.angelina@machung.ac.id']);
fputcsv($f, ['0712038404', 'Reinhard Surya', 'reinhard.surya@machung.ac.id']);
fclose($f);

$f = fopen('template_impor_alumni.csv', 'w');
fputcsv($f, ['Nama Lengkap (Wajib)', 'Email (Wajib)', 'Tahun Lulus']);
fclose($f);

$f = fopen('dummy_alumni.csv', 'w');
fputcsv($f, ['Nama Lengkap (Wajib)', 'Email (Wajib)', 'Tahun Lulus']);
fputcsv($f, ['Andi Setiawan', 'andi.setiawan@gmail.com', '2022']);
fputcsv($f, ['Budi Santoso', 'budi.santoso@yahoo.com', '2022']);
fputcsv($f, ['Citra Kirana', 'citra.k@outlook.com', '2023']);
fputcsv($f, ['Doni Wijaya', 'doni.w@gmail.com', '2023']);
fclose($f);

$f = fopen('template_impor_perusahaan.csv', 'w');
fputcsv($f, ['Nama Perwakilan (Wajib)', 'Email (Wajib)', 'Nama Instansi/Perusahaan']);
fclose($f);

$f = fopen('dummy_perusahaan.csv', 'w');
fputcsv($f, ['Nama Perwakilan (Wajib)', 'Email (Wajib)', 'Nama Instansi/Perusahaan']);
fputcsv($f, ['HRD PT Teknologi Maju', 'hrd@tekmaju.com', 'PT Teknologi Maju']);
fputcsv($f, ['Recruitment CV Solusi Digital', 'rekruitmen@solusidigital.com', 'CV Solusi Digital']);
fputcsv($f, ['Bagus Pratama (Manager IT)', 'bagus@inovasi-sistem.co.id', 'PT Inovasi Sistem']);
fputcsv($f, ['Rina Melati (Direktur HR)', 'rina.hr@karyanusantara.com', 'PT Karya Nusantara']);
fclose($f);

echo "Berhasil membuat file CSV.";
?>
