<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID blog tidak valid.";
    exit;
}

$blog_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("DELETE FROM blog WHERE id = ? AND user_id = ?");
$stmt->execute([$blog_id, $user_id]);

header("Location: index.php");
exit;