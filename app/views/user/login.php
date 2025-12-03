<?php
    $root = '/DungeonXplorer';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Simple</title>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body class="compte">

    <header>
        <?php include(ROOT_DIR . 'app/views/includes/header.php'); ?>
    </header>   
   
    <main>
        <div class="container">
            <h2>Se connecter</h2>
            <form action="<?= $root ?>/src/php/confirmationConnexion.php" method="post">
                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="">Se connecter</button>
            </form>
            <p>Pas encore de compte ?</p>
            <a href="signup.php">
                S'inscrire
            </a>
        </div>
    </main>
</body>
