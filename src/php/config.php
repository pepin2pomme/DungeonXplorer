<?php
    $host = "localhost";
    $db   = "dx08_bd";
    $user = "dx08";
    $pass = "ohtataLib2iophee";

    try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
?>