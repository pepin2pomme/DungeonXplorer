<?php

include_once __DIR__ . '/../config.php';  

class CombatController {

    private $db;

     public function __construct($db) { 
        $this->db = $db; 
    }

    public function start() {
       $hero = EntityDAO::getById($_GET["hero"], DB::get());
        $monster = EntityDAO::getById($_GET["monster"], DB::get());

        $_SESSION["combat"] = new Combat($hero, $monster);
        $log = "Le combat commence !";

        require "php/View/combat.php";
    }

    public function play() {
        $combat = $_SESSION["combat"];
        $action = $_POST["action"];
        $log = "";

        if ($action === "attack") {
            $log .= $combat->heroAttack() . "<br>";

            if (!$combat->isFinished()) {
                $log .= $combat->monsterAttack();
            }
        }

     
    }


    public function startBrutTest() {
      

        $hero = EntityDAO::getById(2, $this->db);
        $monster = EntityDAO::getById(1, $this->db);

        $_SESSION['combat'] = new Combat($hero, $monster);
        $_SESSION['log'] = "Combat initié en brut !";

        $view = new CombatView($_SESSION['combat']);
        $view->render();
    }



}
?>
