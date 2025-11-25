<?php
include_once "config.php";
include_once "Hero.php";
include_once "Monster.php";
include_once "Item.php";

function chargerHero($id){
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM Hero WHERE id = ?");
    $stmt->execute([$id]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) return null;

    return Hero::fromPDO($row);
}

function chargerMonstre($id){
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM Monster WHERE id = ?");
    $stmt->execute([$id]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) return null;

    return Monster::fromPDO($row);
}
?>
