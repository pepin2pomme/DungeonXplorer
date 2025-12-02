<?php
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
}
?>
