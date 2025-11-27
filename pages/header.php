<?php
    session_start();
    $root = '/sites/DungeonXplorer';
    $_SESSION['user'] = 'Woipy';
?>

<header>
        <div class="flex-row">         
            <a class="button" id="logoImg" href="index.php">
                <picture>
                    <source media="(max-width: 768px)" srcset="<?= $root ?>/assets/logo/dungeonLogoMinLight.png">
                    <img src="<?= $root ?>/assets/logo/dungeonLogoFullLight.png" alt="Logo" style="height:34px; width:auto;">
                </picture>            
            </a>
            <a class="button navButton" href="index.php">Accueil</a>
            <a class="button navButton" href="decouvrir.php">Découvrir</a>
        </div>
        <div class="flex-row">
            <a class="button navButton" href="apropos.php">À propos</a>
            <?php if (!isset($_SESSION['user'])): ?>     
            <a class="button navButton" href="login.php">Se connecter</a>
            <?php else: ?>
            <a class="button" id="accountButton" href="profile.php"><?= htmlspecialchars($_SESSION['user']); ?></a>
            <?php endif; ?>
        </div>
</header>
