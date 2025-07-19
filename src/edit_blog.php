<?php
session_start();
require_once 'conn.php';

if (!$_SESSION ['user_id']) {
    header("Location: login.php");
    exit;
}


if (!isset($$_GET['id'])  || !is_numeric(($_GET['id']))) {
    echo "ID blog tidak valid.";
    exit;
}

$blog_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

if(!$blog) {
    echo "Blog tidak ditemukan.";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $judul = trim ($_POST['judul']);
    $deskripsi = trim ($_POST['deskripsi']);

    if ($judul === '' || $Deskripsi === '') {
        $error = "judul deskripsi tidak boleh kosong.";
    } else {
        $stmt = $pdo->prepare("UPDATE blog SET judul = ?, WHERE id = ? AND user_id = ?");
        $stmt->execute([$judul, $deskripsi, $blog_id, $user_id]);
    }
}
?>