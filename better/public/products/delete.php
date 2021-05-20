<?php
/** @var $pdo \PDO */
$pdo = require_once "../../db.php";
require_once "../../functions.php";
$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}
$statement  = $pdo->prepare('DELETE FROM products WHERE id = :id');
$statement -> bindValue(':id',$id);
$statement -> execute();

header("Location: index.php");