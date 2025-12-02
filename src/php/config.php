<?php

$db_username = "dx08";
$db_password = "ohtataLib2iophee";
$host = 'localhost';
//echo 'test premier';

//$db = fabriquerChaineConnexPDO();
try
{

	//echo 'test ctach';
    $db = new PDO('mysql:host=localhost;dbname=dx08_bd;charset=utf8', 'dx08', 'ohtataLib2iophee'); // insérez vos paramètres de connexion à la BDD.
	//Remplace la base de connexion
	//echo 'test ctach';

}

// Gestion des erreurs
catch(Exception $e)
{
 die('Erreur : '.$e->getMessage());
}  