<?php
require_once 'firebase.php';

$firebase = new FirebaseService();
$database = $firebase->getDatabase();

// Ambil data buku dari Firebase
$bukuReference = $database->getReference('Buku');
$bukuData = $bukuReference->getValue();





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_POST['image'];
    $pdf = $_POST['pdf'];

    $idbuku = str_replace(' ', '_', $judul);
    $newBook = [
        'judul' => $judul,
        'author' => $author,
        'category' => $category,
        'deskripsi' => $deskripsi,
        'gambarBuku' => $gambar,
        'jumlahPinjam' => 0,
        'stock' => 1,
        'pdf' => $pdf
    ];

    $database->getReference('Buku/' . $idbuku)->set($newBook);

    echo "Buku berhasil ditambahkan!";
    header('Location: admin.php?message=Buku Berhasil Ditambahkan');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Tambah Buku Baru</h1>

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form action="tambah_buku.php" method="post" class="space-y-4">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                <input type="text" id="judul" name="judul" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
                <input type="text" id="author" name="author" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" id="category" name="category" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Link Cover Buku</label>
                <input type="text" id="image" name="image" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="pdf" class="block text-sm font-medium text-gray-700">Link PDF</label>
                <input type="text" id="pdf" name="pdf" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="inline-flex justify-center py-3 px-5 border border-transparent shadow-lg text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Tambah Buku</button>
                <a href="index.php" class="ml-4 inline-flex justify-center py-3 px-5 border border-gray-300 shadow-lg text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Kembali ke Daftar Buku</a>
            </div>
        </form>
    </div>

    <div class="max-w-6xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Buku</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cover</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">PDF</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($bukuData): ?>
                        <?php foreach ($bukuData as $buku): ?>
                            <tr class="hover:bg-gray-50 transition duration-300 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="<?php echo $buku['gambarBuku']; ?>" alt="Cover Buku" class="w-16 h-24 object-cover rounded-lg shadow-sm">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $buku['judul']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $buku['author']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo $buku['category']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="<?= htmlspecialchars($buku['pdf'] ?? '') ?>" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-semibold underline">Lihat PDF</a>
                                </td>
                                <td class="border border-gray-200 p-3"><?php echo $buku['deskripsi']; ?></td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">Tidak ada buku yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
