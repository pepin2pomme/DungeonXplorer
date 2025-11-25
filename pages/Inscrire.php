<?php

include "connection.php";




$pers_pseudo = $_POST["pseudo"];
$pers_email = $_POST["email"];
$pers_mdp = $_POST['mdp'];


echo $pseudo ,' ', $cli_email,' ', $cli_mdp, ' ',

$sql = "Insert into /*TODO*/ values (null,:psuedo, :email, :mdp)";

$sql2 = "SELECT COUNT(*) FROM rap_client WHERE cli_courriel = :email";




try{
    $conn = OuvrirConnexionPDO($db,$db_username,$db_password);

    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':email', $cli_email);
    $stmt2->execute();

    $count = $stmt2->fetchColumn();
    if ($count > 0) {
        echo "<script>alert('Un email est déjà utilisé pour ce compte.'); window.history.back();</script>";
    } else {

    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':pseudo', $cli_prenom);
    $stmt->bindParam(':email', $cli_email);
    $stmt->bindParam(':mdp', $cli_mdp);

    $stmt->execute();
    echo "<script>alert('Inscription réussie !');
    window.location.href = 'index.php';</script>";

    exit();
    }

    

    }catch(PDOException $e){
        echo "<br>Erreur PDO : " . $e->getMessage();

    }





