<?php
    $pdo = new \PDO('mysql:host=127.0.0.1;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;