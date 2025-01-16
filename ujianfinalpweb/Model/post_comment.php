<?php
session_start();
require_once '../Config/db.php'; // Pastikan untuk mengarah ke file db.php yang benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $text = $_POST['text'];

    // Menyimpan komentar ke dalam database
    $stmt = $pdo->prepare("INSERT INTO comments (name, text) VALUES (?, ?)");
    if ($stmt->execute([$name, $text])) {
        // Redirect kembali ke halaman home setelah menyimpan
        header('Location: ../public/home.php'); 
        exit();
    } else {
        echo "Gagal menambahkan komentar.";
    }
}
?>
