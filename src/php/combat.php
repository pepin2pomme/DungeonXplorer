<?php
session_start();

// Activation erreurs (important pour debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Chargement config + classes
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Controller/CombatController.php';
require_once __DIR__ . '/models/Entity.php';
require_once __DIR__ . '/models/Combat.php';
require_once __DIR__ . '/dao/EntityDAO.php';
require_once __DIR__ . '/View/CombatView.php';

// Router
$controller = new CombatController();

$action = $_GET['action'] ?? 'none';

switch ($action) {
    case 'startBrutTest':
        $controller->startBrutTest();
        break;

    case 'start':
        $controller->start();
        break;

    case 'play':
        $controller->play();
        break;

    default:
        echo "Aucune action reconnue.";
        break;
}
