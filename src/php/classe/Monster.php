<?php

class Monster
{
    public ?int $id;
    public string $name;
    public int $pv;
    public ?int $mana;
    public int $initiative;
    public int $strength;
    public string $attack;
    public int $xp;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? "";
        $this->pv = (int)($data['pv'] ?? 0);
        $this->mana = isset($data['mana']) ? (int)$data['mana'] : null;
        $this->initiative = (int)($data['initiative'] ?? 0);
        $this->strength = (int)($data['strength'] ?? 0);
        $this->attack = $data['attack'] ?? "";
        $this->xp = (int)($data['xp'] ?? 0);
    }

    // 🔄 Charger un monstre depuis PDO
    public static function fromPDO(array $row): Monster
    {
        return new Monster($row);
    }

    function getMonster(PDO $pdo): Monster {
        $stmt = $pdo->query("SELECT * FROM monsters ORDER BY RAND() LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return Monster::fromPDO($row);
    }

    // 🩸 Le monstre est-il mort ?
    public function isDead(): bool
    {
        return $this->pv <= 0;
    }

    // 💥 Infliger des dégâts
    public function takeDamage(int $damage): void
    {
        $this->pv -= $damage;
        if ($this->pv < 0) $this->pv = 0;
    }

    // ⚡ Utiliser du mana
    public function useMana(int $amount): bool
    {
        if ($this->mana !== null && $this->mana >= $amount) {
            $this->mana -= $amount;
            return true;
        }
        return false;
    }

    // 🔄 Convertir en tableau
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'pv' => $this->pv,
            'mana' => $this->mana,
            'initiative' => $this->initiative,
            'strength' => $this->strength,
            'attack' => $this->attack,
            'xp' => $this->xp,
        ];
    }
}
