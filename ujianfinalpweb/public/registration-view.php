<?php
session_start();

// Cek apakah valid_code telah diset
if (!isset($_SESSION['valid_code']) || $_SESSION['valid_code'] !== true) {
    // Jika tidak valid, arahkan kembali ke halaman RSVP
    header("Location: home.php"); // Ganti dengan URL halaman yang sesuai
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/registration-view.css">
    <link rel="stylesheet" href="./style/registration-mobile.css">
    <title>Pendaftaran Tamu</title>

</head>
<body>
<div class="formulir-rsvp">
        <h1>Pendaftaran Tamu</h1>
        <form id="registration-form" action="../Model/registration.php" method="POST" onsubmit="confirmSubmission(event);">
            <input type="text" name="name" placeholder="Nama Lengkap" required maxlength="50">
            <input type="email" name="email" placeholder="Alamat Email" required maxlength="50">
            <input type="text" name="phone" placeholder="Nomor Telepon" maxlength="15" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="number" name="guests_count" placeholder="Jumlah Tamu yang Dibawa" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <textarea name="notes" placeholder="Ucapan Selamat"></textarea>
            <blockquote>*<strong>Notes:</strong> Ucapan selamat akan ditampilkan di halaman utama</blockquote>
            <button type="submit">Kirim</button>
        </form>

        <!-- Modal Konfirmasi -->
        <div id="confirmation-modal" class="modal">
            <div class="modal-content">
                <span id="close-modal" style="cursor:pointer; float:right;">&times;</span>
                <h2>Konfirmasi Data</h2>
                <p id="confirmation-message"></p>
                <div class="confirm-wrapping">
                    <button id="confirm-button">Ya, Proses Data</button>
                    <button id="cancel-button">Tidak, Batalkan</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/javascript/registration-view.js"></script>
</body>
</html>
