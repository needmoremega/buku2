<?php
require_once 'firebase.php';

// Inisialisasi Firebase
$firebase = new FirebaseService();
$database = $firebase->getDatabase();

// Ambil data dari Firebase
$bukuData = $database->getReference('Buku')->getValue();
$userData = $database->getReference('Users')->getValue();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tab-content {
            display: none;
        }
        .tab-active {
            display: block;
        }
        .section-container {
            margin-top: 20px;
            padding: 20px;
            border-radius: 8px;
        }
        .buku-section {
            background-color: #f0f4f8;
        }
        .user-section {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-blue-600 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-white text-2xl font-bold">Admin Panel</h1>
    </div>
</nav>

<!-- Tab Navigation -->
<div class="container mx-auto mt-6">
    <div class="tabs">
        <a href="#buku" class="tab tab-lifted tab-active" onclick="switchTab(event, 'buku')">Buku</a>
        <a href="#user" class="tab tab-lifted" onclick="switchTab(event, 'user')">User</a>
    </div>
</div>

<!-- Tab Content -->
<div class="container mx-auto mt-6">
    <!-- Buku Tab -->
    <div id="buku" class="tab-content tab-active section-container buku-section">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Data Buku</h2>
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="border border-gray-200 p-2">No</th>
                    <th class="border border-gray-200 p-2">Judul</th>
                    <th class="border border-gray-200 p-2">Penulis</th>
                    <th class="border border-gray-200 p-2">Kategori</th>
                    <th class="border border-gray-200 p-2">Deskripsi</th>
                    <th class="border border-gray-200 p-2">Gambar</th>
                    <th class="border border-gray-200 p-2">Jumlah Pinjam</th>
                    <th class="border border-gray-200 p-2">Stock</th>
                    <th class="border border-gray-200 p-2">PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bukuData)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($bukuData as $buku): ?>
                        <tr>
                            <td class="border border-gray-200 p-2"><?= $no++ ?></td>
                            <td class="border border-gray-200 p-2"><?= htmlspecialchars($buku['judul']) ?></td>
                            <td class="border border-gray-200 p-2"><?= htmlspecialchars($buku['author']) ?></td>
                            <td class="border border-gray-200 p-2"><?= htmlspecialchars($buku['category']) ?></td>
                            <td class="border border-gray-200 p-2"><?= htmlspecialchars($buku['deskripsi']) ?></td>
                            <td class="border border-gray-200 p-2">
                                <img src="<?= htmlspecialchars($buku['gambarBuku']) ?>" alt="Gambar Buku" class="h-16 w-16 object-cover">
                            </td>
                            <td class="border border-gray-200 p-2"><?= htmlspecialchars($buku['jumlahPinjam']) ?></td>
                            <td class="border border-gray-200 p-2"><?= htmlspecialchars($buku['stock']) ?></td>
                            <td class="border border-gray-200 p-2">
                                <a href="<?= htmlspecialchars($buku['pdf']) ?>" target="_blank" class="text-blue-500">Lihat PDF</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="border border-gray-200 p-2 text-center">Tidak ada data buku.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>

    <!-- User Tab -->
    <div class="container mx-auto mt-6">
    <div id="user" class="tab-content section-container user-section">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Data User</h2>
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="border border-gray-200 p-2">No</th>
                    <th class="border border-gray-200 p-2">Username</th>
                    <th class="border border-gray-200 p-2">Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($userData)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($userData as $username => $user): ?>
                        <tr>
                            <td class="border border-gray-200 p-2"><?= $no++ ?></td>
                            <td class="border border-gray-200 p-2"><?= htmlspecialchars($username) ?></td>
                            <td class="border border-gray-200 p-2"><?= $user['admin'] ? 'Yes' : 'No' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="border border-gray-200 p-2 text-center">Tidak ada data user.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>


<script>
    function switchTab(event, tabName) {
        // Menghapus kelas aktif dari semua tab dan konten
        const tabs = document.querySelectorAll('.tab');
        const contents = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.remove('tab-active'));
        contents.forEach(content => content.classList.remove('tab-active'));
        
        // Menambahkan kelas aktif pada tab yang dipilih dan kontennya
        event.currentTarget.classList.add('tab-active');
        document.getElementById(tabName).classList.add('tab-active');
    }
</script>

</body>
</html>
