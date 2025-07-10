<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $user_id = $_SESSION['user_id']; 

    if (empty($judul) || empty($deskripsi)) {
        $error = "Judul dan deskripsi tidak boleh kosong.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO blog (judul, deskripsi, user_id) VALUES (?, ?, ?)");
        if ($stmt->execute([$judul, $deskripsi, $user_id])) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Terjadi kesalahan saat menyimpan data.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/tambah_blogs.css">
</head>
<body>

<div class="form-container">
    <h2>Tambah Postingan Blog</h2>

    <?php if (!empty($error)): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" required></textarea>

        <button type="submit">Simpan</button>
    </form>

    <a class="back-link" href="index.php">← Kembali ke Beranda</a>
</div>

</body>
</html>
