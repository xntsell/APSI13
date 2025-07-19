<?php 
session_start();
require_once 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric(($_GET['id']))) {
    echo "ID blog tidak valid.";
    exit;
}

$blog_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM  blog WHERE id = ?  AND user_id = ?");
$stmt->execute([$blog_id, $user_id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$blog) {
    echo "blog tidak di temukan";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);

    if ($judul === '' || $deskripsi === '') {
        $error = "Judul dan deskripsi tidak boleh kosong.";
    } else {
        $stmt = $pdo->prepare("UPDATE blog SET judul = ?, deskripsi = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$judul, $deskripsi, $blog_id, $user_id]);

        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/edit_blogs.css">
    <title>Document</title>
</head>
<body>

<div class="header"> 
    <h2>edit blog</h2>
    <a href="index.php">kembali ke beranda</a>
</div>

<form method="POST">
    <label for="judul"> judul:</label><br>
    <input type="text" name="judul" id="judul" 
    value="<?=  htmlspecialchars(($blog['judul'])) ?>" required><br><br>
   
    <label for="deskripsi">deskripsi:</label><br>
    <textarea name="deskripsi" rows="10" id="deskripsi" required> 
        <?= htmlspecialchars(($blog['deskripsi'])) ?></textarea><br> <br>
        <button type="submit"> update blog</button>
</form>
    
</body>
</html>