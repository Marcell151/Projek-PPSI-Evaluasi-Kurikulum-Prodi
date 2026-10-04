<?php
// api/submit-final.php
require_once '../config/app.php';
require_once '../config/database.php';
require_once '../includes/helpers.php';
require_once '../includes/auth.php';
require_once '../includes/csrf.php';

if (!is_logged_in() || $_SESSION['user_role'] === 'admin' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('auth/login.php');
}

if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
    set_flash_message('error', 'Token CSRF tidak valid.');
    redirect('responden/formulir.php');
}

$pengisian_id = $_POST['pengisian_id'] ?? null;

if (!$pengisian_id) {
    set_flash_message('error', 'Sesi evaluasi tidak ditemukan.');
    redirect('responden/beranda.php');
}

try {
    // Validasi apakah benar milik user ini dan masih draft
    $stmt = $pdo->prepare("SELECT * FROM pengisian WHERE id = ? AND pengguna_id = ? AND status = 'draft'");
    $stmt->execute([$pengisian_id, $_SESSION['user_id']]);
    $pengisian = $stmt->fetch();

    if (!$pengisian) {
        set_flash_message('error', 'Evaluasi tidak valid atau sudah disubmit sebelumnya.');
        redirect('responden/beranda.php');
    }
    
    // Validasi minimal 1 matkul (via db)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM pengisian_matkul WHERE pengisian_id = ?");
    $stmt->execute([$pengisian_id]);
    $jml_matkul = $stmt->fetchColumn();
    
    if ($jml_matkul == 0) {
        set_flash_message('error', 'Anda harus memilih minimal 1 mata kuliah.');
        redirect('responden/formulir.php');
    }

    // Jika lewat validasi, ubah status jadi final
    $stmt = $pdo->prepare("UPDATE pengisian SET status = 'final', waktu_submit = NOW() WHERE id = ?");
    $stmt->execute([$pengisian_id]);

    set_flash_message('success', 'Evaluasi Anda berhasil disubmit secara final. Terima kasih atas partisipasinya.');
    redirect('responden/beranda.php');

} catch (Exception $e) {
    set_flash_message('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
    redirect('responden/formulir.php');
}
?>
