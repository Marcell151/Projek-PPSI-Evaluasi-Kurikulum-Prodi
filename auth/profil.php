<?php
// auth/profil.php
require_once '../config/app.php';
require_once '../config/database.php';
require_once '../includes/helpers.php';
require_once '../includes/auth.php';
require_once '../includes/csrf.php';

require_login();

$user_id = $_SESSION['user_id'];
$page_title = 'Profil Saya';

// Ambil data profil saat ini
$stmt = $pdo->prepare("SELECT u.*, p.nomor_induk, p.tahun_lulus, p.instansi FROM pengguna u LEFT JOIN profil_pengguna p ON u.id = p.pengguna_id WHERE u.id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash_message('error', 'Token CSRF tidak valid.');
        redirect('auth/profil.php');
    }

    $action = $_POST['action'] ?? '';
    
    if ($action === 'ubah_password') {
        $password_lama = $_POST['password_lama'] ?? '';
        $password_baru = $_POST['password_baru'] ?? '';
        $konfirmasi = $_POST['konfirmasi'] ?? '';
        
        if (password_verify($password_lama, $user['password_hash'])) {
            if ($password_baru === $konfirmasi) {
                if (strlen($password_baru) >= 6) {
                    $hash_baru = password_hash($password_baru, PASSWORD_BCRYPT);
                    $stmt = $pdo->prepare("UPDATE pengguna SET password_hash = ?, wajib_ganti_sandi = FALSE WHERE id = ?");
                    $stmt->execute([$hash_baru, $user_id]);
                    set_flash_message('success', 'Kata sandi berhasil diubah.');
                    $_SESSION['wajib_ganti_sandi'] = false; // Update session
                } else {
                    set_flash_message('error', 'Kata sandi baru minimal 6 karakter.');
                }
            } else {
                set_flash_message('error', 'Konfirmasi kata sandi tidak cocok.');
            }
        } else {
            set_flash_message('error', 'Kata sandi lama salah.');
        }
    } elseif ($action === 'ubah_profil') {
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        
        if ($nama && $email) {
            try {
                $stmt = $pdo->prepare("UPDATE pengguna SET nama = ?, email = ? WHERE id = ?");
                $stmt->execute([$nama, $email, $user_id]);
                $_SESSION['user_name'] = $nama;
                set_flash_message('success', 'Profil berhasil diperbarui.');
            } catch (Exception $e) {
                set_flash_message('error', 'Gagal memperbarui: Email mungkin sudah dipakai.');
            }
        }
    }
    
    redirect('auth/profil.php');
}

require_once '../includes/header.php';
?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex flex-col md:flex-row md:items-center gap-4">
        <div class="w-20 h-20 bg-brand-50 text-brand-500 rounded-full flex items-center justify-center text-4xl border-4 border-brand-100">
            <i class="ph ph-user"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-900"><?= escape($user['nama']) ?></h2>
            <p class="text-gray-500 flex items-center gap-2">
                <i class="ph ph-envelope-simple"></i> <?= escape($user['email']) ?>
            </p>
            <div class="mt-2 flex gap-2">
                <span class="px-2.5 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-lg uppercase tracking-wider"><?= escape($user['peran']) ?></span>
                <?php if ($user['wajib_ganti_sandi']): ?>
                    <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-lg flex items-center gap-1"><i class="ph ph-warning-circle"></i> Wajib Ganti Sandi</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    
    <!-- Informasi Profil -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
            <i class="ph ph-identification-card text-brand-500 text-lg"></i> Informasi Dasar
        </h3>
        <form action="" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="ubah_profil">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" value="<?= escape($user['nama']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" name="email" value="<?= escape($user['email']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required>
            </div>
            
            <!-- Read-only fields based on role -->
            <?php if ($user['peran'] === 'mahasiswa' || $user['peran'] === 'dosen'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk (NIM/NIDN)</label>
                    <input type="text" value="<?= escape($user['nomor_induk'] ?? '-') ?>" class="w-full px-3 py-2 border border-gray-200 bg-gray-50 rounded-lg text-sm text-gray-500 outline-none cursor-not-allowed" readonly>
                    <p class="text-xs text-gray-400 mt-1">Hubungi Admin Prodi untuk mengubah Nomor Induk.</p>
                </div>
            <?php elseif ($user['peran'] === 'alumni'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus</label>
                    <input type="text" value="<?= escape($user['tahun_lulus'] ?? '-') ?>" class="w-full px-3 py-2 border border-gray-200 bg-gray-50 rounded-lg text-sm text-gray-500 outline-none cursor-not-allowed" readonly>
                </div>
            <?php elseif ($user['peran'] === 'perusahaan'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instansi/Perusahaan</label>
                    <input type="text" value="<?= escape($user['instansi'] ?? '-') ?>" class="w-full px-3 py-2 border border-gray-200 bg-gray-50 rounded-lg text-sm text-gray-500 outline-none cursor-not-allowed" readonly>
                </div>
            <?php endif; ?>
            
            <div class="pt-4 text-right">
                <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-sm">Simpan Profil</button>
            </div>
        </form>
    </div>

    <!-- Ubah Kata Sandi -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
            <i class="ph ph-lock-key text-brand-500 text-lg"></i> Ubah Kata Sandi
        </h3>
        
        <?php if ($user['wajib_ganti_sandi']): ?>
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 text-sm text-yellow-800 mb-4 flex gap-2">
                <i class="ph ph-info mt-0.5"></i>
                <p>Anda masih menggunakan kata sandi bawaan (default). Demi keamanan, Anda <strong>wajib</strong> mengubahnya sekarang.</p>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="ubah_password">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Saat Ini <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" name="password_lama" id="pwd_lama" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required>
                    <button type="button" onclick="togglePwd('pwd_lama')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-500"><i class="ph ph-eye"></i></button>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" name="password_baru" id="pwd_baru" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required minlength="6">
                    <button type="button" onclick="togglePwd('pwd_baru')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-500"><i class="ph ph-eye"></i></button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter.</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" name="konfirmasi" id="pwd_konfirm" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required minlength="6">
                    <button type="button" onclick="togglePwd('pwd_konfirm')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-brand-500"><i class="ph ph-eye"></i></button>
                </div>
            </div>
            
            <div class="pt-4 text-right">
                <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-sm">Ubah Kata Sandi</button>
            </div>
        </form>
    </div>
    
</div>

<script>
function togglePwd(id) {
    const el = document.getElementById(id);
    const icon = el.nextElementSibling.querySelector('i');
    if (el.type === 'password') {
        el.type = 'text';
        icon.classList.remove('ph-eye');
        icon.classList.add('ph-eye-slash');
    } else {
        el.type = 'password';
        icon.classList.remove('ph-eye-slash');
        icon.classList.add('ph-eye');
    }
}
</script>

<?php require_once '../includes/footer.php'; ?>
