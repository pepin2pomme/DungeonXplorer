<?php
// Inclure les classes
require_once 'CombatAdvanced.php';
require_once 'Hero.php';
require_once 'Monster.php';
require_once 'db_connection.php'; // Contient la connexion à la base de données

// Vérifier si la requête est une demande de combat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data['action'] === 'start_combat') {
        // Récupérer un héros et un monstre
        $hero = getHero($pdo);
        $monster = getMonster($pdo);

        // Initialiser le combat
        $combat = new CombatAdvanced($hero, $monster);
        $combat->start();

        // Renvoyer les informations du combat en JSON
        echo json_encode([
            'hero' => $hero->toArray(),
            'monster' => $monster->toArray(),
            'log' => $combat->log
        ]);
    }
}
?>
