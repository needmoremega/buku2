<?php
require_once 'firebase.php';

// Inisialisasi Firebase
$firebase = new FirebaseService();
$database = $firebase->getDatabase();

// Ambil data dari Firebase
$bukuData = $database->getReference('Buku')->getValue();
$userData = $database->getReference('Users')->getValue();
$message = $_GET['message'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-1/4 min-h-screen flex flex-col p-6">
            <h2 class="text-2xl font-bold text-center mt-6 mb-4">Admin Panel</h2>
            <nav class="flex flex-col space-y-4">
                <button onclick="switchTab('buku')" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md focus:outline-none">📚 Buku</button>
                <button onclick="switchTab('user')" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md focus:outline-none">👥 User</button>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="w-3/4 p-8">
            <!-- Pesan -->
            <?php if (!empty($message)): ?>
                <div id="message" class="mb-4 p-4 bg-green-100 text-green-700 rounded-md shadow">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <!-- Buku Tab -->
            <div id="buku" class="tab-content">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-semibold">Daftar Buku</h2>
                    <a href="tambah_buku.php" class="py-2 px-4 bg-green-500 hover:bg-green-600 text-white rounded-md shadow">
                        + Tambah Buku
                    </a>
                </div>
                <div class="overflow-x-auto bg-white rounded shadow-lg">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-2 px-4 text-left">No</th>
                                <th class="py-2 px-4 text-left">Judul</th>
                                <th class="py-2 px-4 text-left">Penulis</th>
                                <th class="py-2 px-4 text-left">Kategori</th>
                                <th class="py-2 px-4 text-left">Deskripsi</th>
                                <th class="py-2 px-4 text-left">Gambar</th>
                                <th class="py-2 px-4 text-left">Stock</th>
                                <th class="py-2 px-4 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bukuData)): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($bukuData as $id => $buku): ?>
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="py-2 px-4"><?= $no++ ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($buku['judul']) ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($buku['author']) ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($buku['category']) ?></td>
                                        <td class="py-2 px-4">
                                            <?= strlen($buku['deskripsi']) > 25 
                                                ? htmlspecialchars(substr($buku['deskripsi'], 0, 25)) . '...' 
                                                : htmlspecialchars($buku['deskripsi']) ?>
                                        </td>
                                        <td class="py-2 px-4">
                                            <img src="<?= htmlspecialchars($buku['gambarBuku']) ?>" alt="Gambar Buku" class="rounded max-h-16 shadow-sm">
                                        </td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($buku['stock']) ?></td>
                                        <td class="py-2 px-4">
                                            <div class="flex gap-x-2">
                                                <a href="edit_buku.php?id=<?= $id ?>" class="py-1 px-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow">Edit</a>
                                                <button onclick="confirmDelete('<?= $id ?>', 'buku')" class="py-1 px-3 bg-red-500 hover:bg-red-600 text-white rounded-md shadow">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-600">Tidak ada data buku.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- User Tab -->
            <div id="user" class="tab-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-semibold">Data User</h2>
                </div>
                <div class="overflow-x-auto bg-white rounded shadow-lg">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-2 px-4 text-left">No</th>
                                <th class="py-2 px-4 text-left">Username</th>
                                <th class="py-2 px-4 text-left">Admin</th>
                                <th class="py-2 px-4 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($userData)): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($userData as $username => $user): ?>
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="py-2 px-4"><?= $no++ ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($username) ?></td>
                                        <td class="py-2 px-4"><?= $user['admin'] ? 'Yes' : 'No' ?></td>
                                        <td class="py-2 px-4">
                                            <button onclick="confirmDelete('<?= $username ?>', 'user')" class="py-1 px-3 bg-red-500 hover:bg-red-600 text-white rounded-md shadow">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada data user.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
            // Mengecek apakah pesan ada di halaman
    window.onload = function() {
        var messageElement = document.getElementById('message');
        if (messageElement) {
            // Hapus pesan setelah 5 detik (5000 milidetik)
            setTimeout(function() {
                messageElement.style.display = 'none';
            }, 5000); // 5000ms = 5 detik
        }
    };
        // Fungsi untuk konfirmasi penghapusan data
        function confirmDelete(id, type) {
            const confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (confirmation) {
                window.location.href = `hapus_data.php?id=${id}&type=${type}`;
            }
        }

        // Fungsi untuk mengalihkan antar tab
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            document.getElementById(tabId).classList.remove('hidden');
        }

        // Sembunyikan pesan setelah 3 detik
        window.addEventListener('DOMContentLoaded', () => {
            const messageElement = document.getElementById('message');
            if (messageElement) {
                setTimeout(() => {
                    messageElement.classList.add('hidden');
                }, 3000);
            }
        });
    </script>

</body>
</html>
