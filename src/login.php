<?php
session_start();
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name         = trim($_POST["name"]);
    $raw_password = trim($_POST["password"]);

    if (empty($name) || empty($raw_password)) {
        $error = "Nama dan password harus diisi.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM login WHERE name = ?");
        $stmt->execute([$name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($raw_password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Nama atau password salah.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/logins.css">
</head>
<body>

<div class="form-container">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Nama Pengguna:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Kata Sandi:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login bro</button>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </form>
</div>

</body>
</html>
