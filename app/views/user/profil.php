<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Index Page</title>
    <link rel="stylesheet" href="src/css/styles.css">
</head>
<body>

    <?php include('pages/header.php'); ?>

    <main>
        `<section id="home">
            <h2><?= htmlspecialchars($_SESSION['pseudo']); ?></h2>
            <p>This is the main section of the homepage.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 My Website. All rights reserved.</p>
    </footer>

</body>
</html>
