<?php
require_once 'firebase.php';

$firebase = new FirebaseService();
$database = $firebase->getDatabase();

// Ambil data buku dari Firebase
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
</head>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nextButton = document.querySelector('[data-carousel-next]');
        const prevButton = document.querySelector('[data-carousel-prev]');
        const carousel = document.querySelector('[data-carousel="slide"]');
        let index = 0;

        const items = carousel.querySelectorAll('.carousel-item');
        const totalItems = items.length;

        function updateCarousel() {
            const offset = -index * 100;
            carousel.style.transform = `translateX(${offset}%)`;
        }

        nextButton.addEventListener('click', function() {
            index = (index + 1) % totalItems;
            updateCarousel();
        });

        prevButton.addEventListener('click', function() {
            index = (index - 1 + totalItems) % totalItems;
            updateCarousel();
        });
    });
</script>

<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-blue-600 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-white text-2xl font-bold">BukuLuku</a>
        <ul class="flex space-x-6">
            <li><a href="#" class="text-white hover:text-blue-300">Home</a></li>
            <li><a href="#" class="text-white hover:text-blue-300">Katalog</a></li>
            <li><a href="#" class="text-white hover:text-blue-300">Profil</a></li>
        </ul>
    </div>
</nav>

<!-- Slider -->
<div class="mt-6">
    <div id="carouselExample" class="relative w-full" data-carousel="slide">
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <div class="flex transition-transform duration-700 ease-in-out" style="transform: translateX(0)">
                <?php if ($dataBerita): ?>
                    <?php foreach ($dataBerita as $berita): ?>
                        <div class="carousel-item min-w-full">
                            <img src="<?php echo $berita['gambar']; ?>" alt="<?php echo $berita['judul']; ?>" class="w-full h-full object-cover">
                            <p class="text-center text-white"><?php echo $berita['judul']; ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-white">Tidak ada berita yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
        <button type="button" class="absolute top-0 left-0 z-30 inline-flex items-center justify-center px-4 py-2 text-white bg-black bg-opacity-50 hover:bg-opacity-75 focus:outline-none" data-carousel-prev>
            <span class="text-2xl">&lt;</span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 inline-flex items-center justify-center px-4 py-2 text-white bg-black bg-opacity-50 hover:bg-opacity-75 focus:outline-none" data-carousel-next>
            <span class="text-2xl">&gt;</span>
        </button>
    </div>
</div>

<!-- Daftar Buku -->
<div class="container mx-auto mt-8">
    <h2 class="text-3xl font-semibold text-gray-800">Daftar Buku</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        <?php if ($bukuData): ?>
            <?php foreach ($bukuData as $bukuId => $buku): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Gambar Buku -->
                    <img src="<?php echo $buku['gambarBuku']; ?>" alt="Buku" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <!-- Judul Buku -->
                        <h3 class="text-lg font-semibold text-gray-700"><?php echo $buku['judul']; ?></h3>
                        <!-- Deskripsi Buku -->
                        <p class="text-sm text-gray-500"><?php echo $buku['deskripsi']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada buku yang tersedia.</p>
        <?php endif; ?>
</div>

</body>
</html>
