   <ul class="nav-links">
    <div class="nav-left z-20">
        <li><a href="index.php">Bienvenue</a></li>
        <li><a href="menu.php"></a> Héro</li>
    </div>
    <div class="nav-right">
        <?php
        session_start();
        if(isset($_SESSION['is_logged_in'])){
            echo "<p>Bienvenue ".$_SESSION['pseudo']."</p>";
            
            //TODO ADMIN

            echo '<li id="inscription"><a href="deconnexion/deconnexion.php">Se Déconnecter</a></li>';
        } else{
            $text = "S'inscrire";
            echo '<li id="inscription"><a href="Inscription.php">'.$text.'</a></li>
            <li id="connexion"><a href="seConnecter.php">Se Connecter</a></li>';
        }
        ?>
    </div>
</ul>