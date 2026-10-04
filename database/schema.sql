CREATE DATABASE IF NOT EXISTS evaluasi_kurikulum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE evaluasi_kurikulum;

CREATE TABLE pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    peran ENUM('admin', 'mahasiswa', 'alumni', 'perusahaan', 'dosen') NOT NULL,
    wajib_ganti_sandi BOOLEAN DEFAULT TRUE,
    aktif BOOLEAN DEFAULT TRUE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE profil_pengguna (
    pengguna_id INT PRIMARY KEY,
    nomor_induk VARCHAR(50) NULL,
    alamat TEXT NULL,
    telepon VARCHAR(20) NULL,
    posisi_pekerjaan VARCHAR(100) NULL,
    instansi VARCHAR(100) NULL,
    tahun_lulus YEAR NULL,
    foto VARCHAR(255) NULL,
    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id) ON DELETE RESTRICT
);

CREATE TABLE periode_evaluasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tahun_akademik VARCHAR(20) NOT NULL,
    status ENUM('draft', 'buka', 'tutup') DEFAULT 'draft',
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kategori_kompetensi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    deskripsi TEXT NULL,
    aktif BOOLEAN DEFAULT TRUE
);

CREATE TABLE bahan_kajian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(20) UNIQUE NOT NULL,
    nama_id VARCHAR(150) NOT NULL,
    nama_en VARCHAR(150) NULL,
    kategori_kompetensi_id INT NULL,
    FOREIGN KEY (kategori_kompetensi_id) REFERENCES kategori_kompetensi(id) ON DELETE SET NULL
);

CREATE TABLE mata_kuliah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(150) NOT NULL,
    deskripsi_singkat TEXT NULL,
    semester INT NULL,
    sks INT NOT NULL,
    jenis ENUM('wajib','pilihan') DEFAULT 'wajib',
    kelompok ENUM('universitas','fakultas','prodi') DEFAULT 'prodi',
    kurikulum VARCHAR(10) DEFAULT '2024',
    aktif BOOLEAN DEFAULT TRUE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE mata_kuliah_bk (
    mata_kuliah_id INT NOT NULL,
    bahan_kajian_id INT NOT NULL,
    utama TINYINT DEFAULT 0,
    PRIMARY KEY (mata_kuliah_id, bahan_kajian_id),
    FOREIGN KEY (mata_kuliah_id) REFERENCES mata_kuliah(id) ON DELETE CASCADE,
    FOREIGN KEY (bahan_kajian_id) REFERENCES bahan_kajian(id) ON DELETE CASCADE
);

CREATE TABLE pertanyaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10) NULL,
    teks TEXT NOT NULL,
    bantuan TEXT NULL,
    tipe ENUM('pilihan_ganda', 'skala', 'teks', 'pilihan_ganda_banyak') NOT NULL,
    bagian ENUM('matkul', 'kompetensi') NOT NULL,
    peran_sasaran ENUM('mahasiswa', 'alumni', 'perusahaan', 'dosen', 'semua') NOT NULL,
    kategori_kompetensi_id INT NULL,
    wajib BOOLEAN DEFAULT TRUE,
    label_skala JSON NULL,
    syarat_tampil VARCHAR(255) NULL,
    penanda VARCHAR(255) NULL,
    maks_pilihan INT NULL,
    urutan INT DEFAULT 0,
    aktif BOOLEAN DEFAULT TRUE,
    default_aktif BOOLEAN DEFAULT TRUE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_kompetensi_id) REFERENCES kategori_kompetensi(id) ON DELETE RESTRICT
);

CREATE TABLE opsi_pertanyaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pertanyaan_id INT NOT NULL,
    teks_opsi VARCHAR(255) NOT NULL,
    kategori_kompetensi_id INT NULL,
    urutan INT DEFAULT 0,
    aktif BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (pertanyaan_id) REFERENCES pertanyaan(id) ON DELETE RESTRICT,
    FOREIGN KEY (kategori_kompetensi_id) REFERENCES kategori_kompetensi(id) ON DELETE RESTRICT
);

CREATE TABLE pengisian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pengguna_id INT NOT NULL,
    periode_id INT NOT NULL,
    status ENUM('draft', 'final') DEFAULT 'draft',
    tab_terakhir INT DEFAULT 1,
    terakhir_disimpan TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    waktu_submit TIMESTAMP NULL,
    UNIQUE (pengguna_id, periode_id),
    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id) ON DELETE RESTRICT,
    FOREIGN KEY (periode_id) REFERENCES periode_evaluasi(id) ON DELETE RESTRICT
);

CREATE TABLE pengisian_matkul (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pengisian_id INT NOT NULL,
    mata_kuliah_id INT NOT NULL,
    UNIQUE (pengisian_id, mata_kuliah_id),
    FOREIGN KEY (pengisian_id) REFERENCES pengisian(id) ON DELETE RESTRICT,
    FOREIGN KEY (mata_kuliah_id) REFERENCES mata_kuliah(id) ON DELETE RESTRICT
);

CREATE TABLE jawaban (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pengisian_id INT NOT NULL,
    pertanyaan_id INT NOT NULL,
    mata_kuliah_id INT NULL,
    nilai_skala TINYINT NULL,
    opsi_id INT NULL,
    teks TEXT NULL,
    alasan TEXT NULL,
    FOREIGN KEY (pengisian_id) REFERENCES pengisian(id) ON DELETE RESTRICT,
    FOREIGN KEY (pertanyaan_id) REFERENCES pertanyaan(id) ON DELETE RESTRICT,
    FOREIGN KEY (mata_kuliah_id) REFERENCES mata_kuliah(id) ON DELETE RESTRICT,
    FOREIGN KEY (opsi_id) REFERENCES opsi_pertanyaan(id) ON DELETE RESTRICT
);

CREATE TABLE jawaban_multi (
    jawaban_id INT NOT NULL,
    opsi_id INT NOT NULL,
    PRIMARY KEY (jawaban_id, opsi_id),
    FOREIGN KEY (jawaban_id) REFERENCES jawaban(id) ON DELETE CASCADE,
    FOREIGN KEY (opsi_id) REFERENCES opsi_pertanyaan(id) ON DELETE RESTRICT
);

CREATE TABLE tiket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pengguna_id INT NOT NULL,
    subjek VARCHAR(150) NOT NULL,
    isi TEXT NOT NULL,
    status ENUM('baru', 'diproses', 'selesai') DEFAULT 'baru',
    balasan_admin TEXT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    diperbarui_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id) ON DELETE RESTRICT
);

CREATE TABLE log_impor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    nama_berkas VARCHAR(255) NOT NULL,
    jumlah_berhasil INT DEFAULT 0,
    jumlah_gagal INT DEFAULT 0,
    ringkasan_galat TEXT NULL,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES pengguna(id) ON DELETE RESTRICT
);
