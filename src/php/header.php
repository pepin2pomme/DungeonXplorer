<?php
session_start(); // À garder pour vérifier la session !
echo("dans php");
?>

<header>
    <nav>
        <ul>

            <li><a href="index.php">Accueil</a></li>

            <?php if (!isset($_SESSION['user'])): ?>
                <!-- Pas connecté -->
                <li><a href="login.php" class="btn-login">Se connecter</a></li>

            <?php else: ?>
                <!-- Connecté -->
                <li class="username">
                    Bonjour, <?= htmlspecialchars($_SESSION['user']['username']); ?>
                </li>
                <li><a href="logout.php" class="btn-logout">Déconnexion</a></li>
            <?php endif; ?>

        </ul>
    </nav>
</header>
