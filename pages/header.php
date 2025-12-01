<?php
    session_start();
    $root = '/sites/DungeonXplorer';
        $_SESSION['user'] = 'Woipy';
    
    
?>

<header>
        <div class="flex-row">         
            <a id="logoImg" href="index.php">
                <picture>
                    <source media="(max-width: 768px)" srcset="<?= $root ?>/assets/logo/dungeonLogoMinLight.png">
                    <img src="<?= $root ?>/assets/logo/dungeonLogoFullLight.png" alt="Logo" style="height:34px; width:auto;">
                </picture>            
            </a>
            <a class="button flex-row" href="index.php">
                <img src="<?= $root ?>/assets/icons/home.png" alt="Logo" style="height:34px; width:auto;">
                <p>Accueil</p>
            </a>
            <a class="button flex-row" href="decouvrir.php">
                <img src="<?= $root ?>/assets/icons/compass.png" alt="Logo" style="height:34px; width:auto;">
                <p>Decouvrir</p>
            </a>
        </div>
        <div class="flex-row">
            <a class="button flex-row" href="apropos.php">
                <img src="<?= $root ?>/assets/icons/info.png" alt="Logo" style="height:34px; width:auto;">
                <p>A propos</p>
            </a>
            <?php if (!isset($_SESSION['user'])): ?>     
                <a class="button flex-row" href="login.php">
                    <img src="<?= $root ?>/assets/icons/account.png" alt="Logo" style="height:34px; width:auto;">
                    <p>Se connecter</p>
                </a>
            <?php else: ?>
                <a class="button flex-row" href="profil.php">
                    <img src="<?= $root ?>/assets/icons/account.png" alt="Logo" style="height:34px; width:auto;">
                    <?= htmlspecialchars($_SESSION['user']); ?>
                </a>
            <?php endif; ?>
        </div>
</header>
