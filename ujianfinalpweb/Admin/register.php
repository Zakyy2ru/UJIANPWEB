<?php
require_once __DIR__ . "/../Config/db.php";
$connection = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $name = $_POST['name'];

    // Mencegah username yang sama
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $error_message = "Username ini sudah terdaftar!";
    } else {
        $sql = "INSERT INTO users (username, password, name, is_admin) VALUES (?, ?, ?, 1)";
        $stmt = $connection->prepare($sql);
        
        if ($stmt->execute([$username, $password, $name])) {
            $success_message = "Registrasi berhasil! Anda sekarang dapat <a href='login.php'>login</a>.";
        } else {
            $error_message = "Registrasi gagal! Silakan coba lagi.";
        }
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Registrasi Admin</h1>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        
        <form method="POST" class="register-form">
            <input type="text" name="name" placeholder="Nama" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Daftar">
        </form>
        <p>Sudah memiliki akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
