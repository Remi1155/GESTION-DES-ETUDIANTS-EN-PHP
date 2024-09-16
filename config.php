<?php

$dsn = "mysql:host=localhost;dbname=data";
$username = "tanjona";
$password = "dodiese7";

try {
    $pdo = new PDO($dsn, username: $username, password: $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connexion failed: " . $e->getMessage();
}
