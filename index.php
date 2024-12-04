<?php
require_once 'firebase.php';

$firebase = new FirebaseService();
$database = $firebase->getDatabase();

// Ambil data dari Firebase
$beritaRef = $database->getReference('Berita');
$dataBerita = $beritaRef->getValue();

$bukuReference = $database->getReference('Buku');
$bukuData = $bukuReference->getValue();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BukuLuku</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .slider-text {
            position: absolute;
            bottom: 10px;
            left: 30px;
            color: white;
            background: rgba(0, 0, 0, 0.6);
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-blue-600 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-white text-2xl font-bold">BukuLuku</a>
        <ul class="flex space-x-4">
            <li><a href="#" class="text-white hover:text-blue-300">Home</a></li>
            <li><a href="#" class="text-white hover:text-blue-300">Katalog</a></li>
            <li><a href="#" class="text-white hover:text-blue-300">Profil</a></li>
        </ul>
    </div>
</nav>

<div class="carousel w-full ">
    <?php if (!empty($dataBerita) && is_array($dataBerita)): ?>
        <?php $index = 1; ?>
        <?php foreach ($dataBerita as $key => $item): ?>
            <?php 
            // Validasi untuk memastikan data 'gambar' dan 'judul' tersedia
            $gambar = isset($item['gambar']) ? $item['gambar'] : null;
            $judul = isset($item['judul']) ? $item['judul'] : 'Judul Tidak Tersedia';

            // Skip jika 'gambar' atau 'judul' tidak valid
            if (!$gambar) {
                continue;
            }
            ?>
            <div id="slide<?= $index ?>" class="carousel-item relative w-full">
                <!-- Gambar dengan tinggi kecil -->
                <img src="<?= htmlspecialchars($gambar) ?>" class="w-full max-h-lvh	" alt="<?= htmlspecialchars($judul) ?>" />
                <div class="slider-text">
                    <h2 class="text-xl font-bold"><?= htmlspecialchars($judul) ?></h2>
                </div>
                <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                    <a href="#slide<?= $index === 1 ? count($dataBerita) : $index - 1 ?>" class="btn btn-circle">❮</a>
                    <a href="#slide<?= $index === count($dataBerita) ? 1 : $index + 1 ?>" class="btn btn-circle">❯</a>
                </div>
            </div>
            <?php $index++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-10">
            <h2 class="text-xl font-bold text-gray-700">Tidak ada berita ditemukan</h2>
        </div>
    <?php endif; ?>
</div>


<!-- Daftar Buku -->
<div class="container mx-auto mt-8">
    <h2 class="text-3xl font-semibold text-gray-800 mb-4">Daftar Buku</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php if (!empty($bukuData) && is_array($bukuData)): ?>
            <?php foreach ($bukuData as $bukuId => $buku): ?>
                <?php 
                $gambarBuku = $buku['gambarBuku'] ?? 'https://via.placeholder.com/150';
                $judulBuku = $buku['judul'] ?? 'Judul Tidak Tersedia';
                $deskripsi = $buku['deskripsi'] ?? 'Deskripsi Tidak Tersedia';
                ?>
                <div class="buku-item bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-95 hover:shadow-lg">
                    <img src="<?= htmlspecialchars($gambarBuku) ?>" alt="Buku" class="w-full max-h-60 object-fit">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-700"><?= htmlspecialchars($judulBuku) ?></h3>
                        <p class="text-sm text-gray-500">
                            <?= strlen($deskripsi) > 100 
                                ? substr($deskripsi, 0, 100) . '...' 
                                : $deskripsi; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-700">Tidak ada buku yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
