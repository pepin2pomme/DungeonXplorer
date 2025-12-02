<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Index Page</title>
    <link rel="stylesheet" href="src/css/styles.css">
</head>
<body>

    <header>
        <h1>Welcome to My livre dont vous etres le hero</h1>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

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

        <form action="src/php/combatRouteur.php" method="get">
            <input type="hidden" name="action" value="startBrutTest">
            <button type="submit">Lancer un combat brut</button>
        </form>

    </main>

    <footer>
        <p>&copy; 2025 My Website. All rights reserved.</p>
    </footer>

</body>
</html>
