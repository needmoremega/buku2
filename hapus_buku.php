<?php
require_once 'firebase.php';

// Cek jika ada parameter ID yang diterima
if (isset($_GET['id'])) {
    $bukuId = $_GET['id'];

    // Inisialisasi Firebase
    $firebase = new FirebaseService();
    $database = $firebase->getDatabase();

    // Menghapus data buku berdasarkan ID
    $database->getReference('Buku/' . $bukuId)->remove();

    // Redirect ke halaman admin setelah penghapusan
    header('Location: admin.php'); // Ganti dengan nama file halaman admin
    exit();
} else {
    echo "ID buku tidak ditemukan!";
}
?>
