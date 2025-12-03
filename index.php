<?php
session_start();

// On recupere l'url
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);
var_dump($url);

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);

if($url==''){
    echo "Accueil";
} elseif($url[0] == 'home'){
    require ROOT_DIR . 'app/views/home/home.php';
    exit;
} elseif($url[0] == 'decouvrir'){
    require ROOT_DIR . 'app/views/home/decouvrir.php';
    exit;
} elseif($url[0] == 'home'){
    require ROOT_DIR . 'app/views/home/about.php';
    exit;
} elseif($url[0] == 'login'){
    require ROOT_DIR . 'app/views/user/login.php';
    exit;
} else {
    http_response_code(404);
    require ROOT_DIR . 'app/views/home/404.php';
    exit;
}