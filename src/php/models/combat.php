<?php
class Combat {

    public $hero;
    public $monster;

    public function __construct($hero, $monster) {
        $this->hero = $hero;
        $this->monster = $monster;
    }

    public function heroAttack() {
        $dmg = $this->hero->strength;
        $this->monster->pv -= $dmg;
        return "Le héros inflige $dmg dégâts !";
    }

    public function monsterAttack() {
        $dmg = $this->monster->strength;
        $this->hero->pv -= $dmg;
        return "Le monstre inflige $dmg dégâts !";
    }

    public function isFinished() {
        return !$this->hero->isAlive() || !$this->monster->isAlive();
    }
}
?>