<?php
session_start();
?>

<header>
    <nav>
        <ul>

            <?php if (!isset($_SESSION['user'])): ?>
                <!-- Pas connecté -->
                <li><a href="index.php">Accueil</a></li>
                <li><a href="decouvrir.php">Découvrir</a></li>
                <li><a href="apropos.php">À propos</a></li>
                <li><a href="login.php" class="btn-login">Se connecter</a></li>

            <?php else: ?>
                <!-- Connecté -->
                <p>feur</p>
            <?php endif; ?>

        </ul>
    </nav>
</header>
