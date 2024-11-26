<?php
require_once 'firebase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firebase = new FirebaseService();
    $database = $firebase->getDatabase();
    // Data buku yang akan ditambahkan

        // Ambil data dari form
        $judul = $_POST['judul'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $deskripsi = $_POST['deskripsi'];
        $gambar = $_POST['image'];
        $pdf = $_POST['pdf'];

    $idbuku = str_replace(' ','_', $judul);
    $newBook = [
        'judul' => $judul,
        'author' => $author,
        'category' => $category,
        'deskripsi' => $deskripsi,
        'gambarBuku' => $gambar,
        'jumlahPinjam' => 0,
        'pdf' => $pdf

    ];

    // Tambahkan ke Firebase
    $database->getReference('Buku/'.$idbuku)->set($newBook);

    echo "Buku berhasil ditambahkan!";
    echo '<br><a href="index.php">Kembali ke Daftar Buku</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku Baru</h1>
    <form action="tambah_buku.php" method="post">
        <label for="judul">Judul Buku:</label><br>
        <input type="text" id="judul" name="judul"><br>
        <label for="author">Penulis:</label><br>
        <input type="text" id="author" name="author"><br>
        <label for="category">Kategori:</label><br>
        <input type="text" id="category" name="category"><br>
        <label for="image">Link Cover Buku:</label><br>
        <input type="text" id="image" name="image"><br>
        <label for="pdf">Link pdf:</label><br>
        <input type="text" id="pdf" name="pdf"><br>
        <label for="deskripsi">Deskripsi:</label><br>
        <textarea id="deskripsi" name="deskripsi"></textarea><br><br>
        <button type="submit">Tambah Buku</button>
    </form>
</body>
</html>
