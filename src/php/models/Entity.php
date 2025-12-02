<?php
class Entity {
    public $id;
    public $nom;
    public $pv;
    public $pvMax;
    public $mana;
    public $manaMax;
    public $strength;

    public function __construct($row) {
        $this->id = $row->ENT_ID;
        $this->nom = $row->ENT_NOM;
        $this->pv = $row->ENT_PV;
        $this->pvMax = $row->ENT_PV_MAX;
        $this->mana = $row->ENT_MANA;
        $this->manaMax = $row->ENT_MANA_MAX;
        $this->strength = $row->ENT_STRENGTH;
    }

    public function isAlive(): bool {
     return $this->pv > 0;
    }
    public function takeDamage(int $amount) {
        $this->pv -= $amount;
        if ($this->pv < 0) $this->pv = 0;
    }

    public function heal(int $amount) {
        $this->pv += $amount;
        if ($this->pv > $this->pvMax) $this->pv = $this->pvMax;
    }
}
?>