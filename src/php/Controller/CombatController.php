<?php
session_start();

include_once __DIR__ . '/../config.php';  

class CombatController {

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

        echo json_encode([
            "heroPV" => $combat->hero->pv,
            "monsterPV" => $combat->monster->pv,
            "log" => $log,
            "finished" => $combat->isFinished()
        ]);
    }


    public function startBrutTest() {
       $db = DB::get();

        $hero = EntityDAO::getById(1, $db);
        $monster = EntityDAO::getById(5, $db);

        $_SESSION['combat'] = new Combat($hero, $monster);
        $_SESSION['log'] = "Combat initié en brut !";

        $view = new CombatView($_SESSION['combat']);
        $view->render();
    }



}
?>
