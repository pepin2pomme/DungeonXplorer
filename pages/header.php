<?php
    session_start();
    $root = '/sites/DungeonXplorer';
?>

<header>
        <div class="flex-row">         
            <a id="logoImg" href="<?= $root ?>">
                <picture>
                    <source media="(max-width: 768px)" srcset="<?= $root ?>/assets/logo/dungeonLogoMinLight.png">
                    <img src="<?= $root ?>/assets/logo/dungeonLogoFullLight.png" alt="Logo" style="height:34px; width:auto;">
                </picture>            
            </a>
            <a class="button flex-row" href="<?= $root ?>">
                <img src="<?= $root ?>/assets/icons/home.png" alt="Logo" style="height:34px; width:auto;">
                <p>Accueil</p>
            </a>
            <a class="button flex-row" href="<?= $root ?>/pages/decouvrir.php">
                <img src="<?= $root ?>/assets/icons/compass.png" alt="Logo" style="height:34px; width:auto;">
                <p>Decouvrir</p>
            </a>
        </div>
        <div class="flex-row">
            <a class="button flex-row" href="<?= $root ?>/pages/apropos.php">
                <img src="<?= $root ?>/assets/icons/info.png" alt="Logo" style="height:34px; width:auto;">
                <p>A propos</p>
            </a>
            <?php if(!isset($_SESSION['is_logged_in'])): ?>
                <a class="button flex-row" href="<?= $root ?>/pages/login.php">
                    <img src="<?= $root ?>/assets/icons/account.png" alt="Logo" style="height:34px; width:auto;">
                    <p>Se connecter</p>
                </a>
            <?php else: ?>
                <a class="button flex-row" href="<?= $root ?>/pages/profil.php">
                    <img src="<?= $root ?>/assets/icons/account.png" alt="Logo" style="height:34px; width:auto;">
                    <?= htmlspecialchars($_SESSION['pseudo']); ?>
                </a>
            <?php endif; ?>
        </div>
</header>
