<?php
session_start();
?>

<header class="flex-row">
    <nav>
        <ul>
            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="decouvrir.php">Découvrir</a></li>
                <li><a href="apropos.php">À propos</a></li>
                <li><a href="login.php" class="btn-login">Se connecter</a></li>
            <?php else: ?>
                <p>feur</p>
            <?php endif; ?>

        </ul>
    </nav>
</header>
