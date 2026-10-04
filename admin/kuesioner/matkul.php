<?php
// admin/kuesioner/matkul.php
require_once '../../config/app.php';
require_once '../../config/database.php';
require_once '../../includes/helpers.php';
require_once '../../includes/auth.php';
require_once '../../includes/csrf.php';

require_role('admin');

$page_title = 'Bank Mata Kuliah';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash_message('error', 'Token CSRF tidak valid.');
        redirect('admin/kuesioner/matkul.php');
    }

    $action = $_POST['action'] ?? '';
    
    if ($action === 'tambah') {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $sks = (int)($_POST['sks'] ?? 0);
        
        if ($kode && $nama && $sks > 0) {
            try {
                $stmt = $pdo->prepare("INSERT INTO mata_kuliah (kode, nama, sks, aktif) VALUES (?, ?, ?, TRUE)");
                $stmt->execute([$kode, $nama, $sks]);
                set_flash_message('success', 'Mata kuliah berhasil ditambahkan.');
            } catch (Exception $e) {
                set_flash_message('error', 'Gagal: Kode mata kuliah mungkin sudah ada.');
            }
        }
    } elseif ($action === 'toggle') {
        $id = $_POST['id'] ?? 0;
        $status = $_POST['status'] == 1 ? 0 : 1; // Balik status
        $stmt = $pdo->prepare("UPDATE mata_kuliah SET aktif = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        set_flash_message('success', 'Status mata kuliah diperbarui.');
    }
    
    redirect('admin/kuesioner/matkul.php');
}

$stmt = $pdo->query("SELECT * FROM mata_kuliah ORDER BY kode ASC");
$matkul_list = $stmt->fetchAll();

require_once '../../includes/header.php';
?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-2xl"><i class="ph ph-books"></i></div>
        <div><h2 class="text-xl font-bold text-gray-900">Bank Mata Kuliah</h2><p class="text-sm text-gray-500">Kelola daftar mata kuliah. Gunakan sakelar On/Off untuk mengaktifkan/menonaktifkan.</p></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2"><i class="ph ph-plus-circle text-brand-500"></i> Tambah Matkul</h3>
            <form action="" method="POST" class="space-y-4">
                <?= csrf_field() ?> <input type="hidden" name="action" value="tambah">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Kode Matkul <span class="text-red-500">*</span></label><input type="text" name="kode" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required placeholder="Misal: MK01"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Matkul <span class="text-red-500">*</span></label><input type="text" name="nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">SKS <span class="text-red-500">*</span></label><input type="number" name="sks" min="1" max="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-500 outline-none" required></div>
                <div class="pt-2"><button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Simpan Matkul</button></div>
            </form>
        </div>
    </div>
    
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-50 shadow-sm z-10">
                        <tr class="border-b border-gray-200 text-sm text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium">Kode</th>
                            <th class="px-6 py-4 font-medium">Nama Mata Kuliah</th>
                            <th class="px-6 py-4 font-medium text-center">SKS</th>
                            <th class="px-6 py-4 font-medium text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($matkul_list as $mk): ?>
                            <tr class="hover:bg-gray-50 transition-colors <?= $mk['aktif'] ? '' : 'opacity-60 bg-gray-50' ?>">
                                <td class="px-6 py-3 text-gray-900 font-medium"><?= escape($mk['kode']) ?></td>
                                <td class="px-6 py-3 text-gray-700"><?= escape($mk['nama']) ?></td>
                                <td class="px-6 py-3 text-gray-700 text-center"><?= escape($mk['sks']) ?></td>
                                <td class="px-6 py-3 text-center">
                                    <form action="" method="POST" class="inline-block m-0 p-0">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="action" value="toggle">
                                        <input type="hidden" name="id" value="<?= $mk['id'] ?>">
                                        <input type="hidden" name="status" value="<?= $mk['aktif'] ?>">
                                        
                                        <button type="submit" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 <?= $mk['aktif'] ? 'bg-brand-500' : 'bg-gray-200' ?>" role="switch" aria-checked="<?= $mk['aktif'] ? 'true' : 'false' ?>">
                                            <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out <?= $mk['aktif'] ? 'translate-x-5' : 'translate-x-0' ?>"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?>
