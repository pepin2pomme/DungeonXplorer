<?php include(ROOT_DIR . 'app/views/includes/header.php'); ?>
<section>
    <h2><?= htmlspecialchars($_SESSION['pseudo']); ?></h2>
    <p>This is the main section of the homepage.</p>
</section>
<?php include(ROOT_DIR . 'app/views/includes/footer.php'); ?>