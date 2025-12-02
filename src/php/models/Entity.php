<?php
class Entity {
    public $id;
    public $name;
    public $pv;
    public $mana;
    public $strength;
    public $initiative;
    public $capacity;
    public $attack;
    public $pvMax;
    public $manaMax;

    public function isAlive() {
        return $this->pv > 0;
    }
}
?>