<?php
require_once 'firebase.php';

// Inisialisasi Firebase
$firebase = new FirebaseService();
$database = $firebase->getDatabase();

// Ambil ID Buku dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: admin.php?message=ID buku tidak valid!');
    exit;
}

// Ambil data buku berdasarkan ID
$buku = $database->getReference('Buku/' . $id)->getValue();

// Jika data buku tidak ditemukan
if (!$buku) {
    header('Location: admin.php?message=Data buku tidak ditemukan!');
    exit;
}

// Proses update data buku
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'judul' => $_POST['judul'],
        'author' => $_POST['author'],
        'category' => $_POST['category'],
        'deskripsi' => $_POST['deskripsi'],
        'gambarBuku' => $_POST['gambarBuku'], // URL gambar
        'stock' => (int)$_POST['stock'],
    ];

    // Simpan perubahan ke Firebase
    $database->getReference('Buku/' . $id)->update($data);

    // Redirect kembali ke halaman admin
    header('Location: admin.php?message=Data buku berhasil diupdate!');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Buku</h2>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="judul" class="block font-medium">Judul</label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label for="author" class="block font-medium">Penulis</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($buku['author']) ?>" class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label for="category" class="block font-medium">Kategori</label>
                <input type="text" id="category" name="category" value="<?= htmlspecialchars($buku['category']) ?>" class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block font-medium">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="w-full border rounded px-4 py-2"><?= htmlspecialchars($buku['deskripsi']) ?></textarea>
            </div>
            <div class="mb-4">
                <label for="gambarBuku" class="block font-medium">URL Gambar</label>
                <input type="text" id="gambarBuku" name="gambarBuku" value="<?= htmlspecialchars($buku['gambarBuku']) ?>" class="w-full border rounded px-4 py-2">
            </div>
            <div class="mb-4">
                <label for="stock" class="block font-medium">Stock</label>
                <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($buku['stock']) ?>" class="w-full border rounded px-4 py-2">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
                <a href="admin.php" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
