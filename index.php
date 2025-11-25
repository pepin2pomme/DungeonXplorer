<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Index Page</title>
    <link rel="stylesheet" href="src/css/styles.css">
</head>
<body>

    <div>
        <p>menubar en dessous</p>
        <?php
        if (!include('src/php/comp/header.php')) {
            echo "<p style='color:red;'>ERREUR : FICHIER header.php INTROUVABLE</p>";
        }
        ?>
    </div>

    <main>
        <section id="home">
            <h2>Home Section</h2>
            <p>This is the main section of the homepage.</p>
        </section>

        <section id="about">
            <h2>About Section</h2>
            <p>This section contains information about the website.</p>
        </section>

        <section id="services">
            <h2>Services Section</h2>
            <p>Learn more about the services we offer.</p>
        </section>

        <section id="contact">
            <h2>Contact Section</h2>
            <p>Get in touch with us here.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 My Website. All rights reserved.</p>
    </footer>

</body>
</html>
