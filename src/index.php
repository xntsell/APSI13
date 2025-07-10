<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT blog.*, login.name AS penulis 
    FROM blog 
    JOIN login ON blog.user_id = login.id 
    ORDER BY blog.created_at DESC
");
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/indexs.css">
</head>
<body>

<div class="header">
    <span>Halo, <?= htmlspecialchars($_SESSION['user_name']) ?> 👋</span>
    <a class="logout" href="logout.php">Logout</a>
    <h2>Daftar Artikel Blog</h2>
    <a class="btn-tambah" href="tambah_blog.php">+ Tambah Blog</a>
</div>

<?php if (count($blogs) > 0): ?>
    <?php foreach ($blogs as $blog): ?>
        <div class="blog">
            <h3><?= htmlspecialchars($blog['judul']) ?></h3>
            <p><?= nl2br(htmlspecialchars($blog['deskripsi'])) ?></p>
            <small><i>Diposting oleh: <?= htmlspecialchars($blog['penulis']) ?> | <?= $blog['created_at'] ?></i></small>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Tidak ada postingan blog untuk saat ini.</p>
<?php endif; ?>

</body>
</html>
