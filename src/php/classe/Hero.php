<?php

class Hero
{
    public ?int $id;
    public string $name;
    public int $class_id;
    public ?string $image;
    public ?string $biography;

    public int $pv;
    public int $mana;
    public int $strength;
    public int $initiative;



    public ?int $armor_item_id;
    public ?int $primary_weapon_item_id;
    public ?int $secondary_weapon_item_id;
    public ?int $shield_item_id;

    public ?string $spell_list;
    public int $xp;
    public int $current_level;

    public function __construct(array $data = [])
    {
        $this->id                       = $data['id'] ?? null;
        $this->name                     = $data['name'] ?? "";
        $this->class_id                 = $data['class_id'] ?? 0;
        $this->image                    = $data['image'] ?? null;
        $this->biography                = $data['biography'] ?? null;

        $this->pv                       = (int)($data['pv'] ?? 0);
        $this->mana                     = (int)($data['mana'] ?? 0);
        $this->strength                 = (int)($data['strength'] ?? 0);
        $this->initiative               = (int)($data['initiative'] ?? 0);

        

        $this->armor_item_id            = $data['armor_item_id'] ?? null;
        $this->primary_weapon_item_id   = $data['primary_weapon_item_id'] ?? null;
        $this->secondary_weapon_item_id = $data['secondary_weapon_item_id'] ?? null;
        $this->shield_item_id           = $data['shield_item_id'] ?? null;

        $this->spell_list               = $data['spell_list'] ?? null;
        $this->xp                       = (int)($data['xp'] ?? 0);
        $this->current_level            = (int)($data['current_level'] ?? 1);
    }

    // 🔄 Charger un héros depuis une ligne PDO
    public static function fromPDO(array $row): Hero
    {
        return new Hero($row);
    }

    function getHero(PDO $pdo): Hero {
        $stmt = $pdo->query("SELECT * FROM heroes ORDER BY RAND() LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return Hero::fromPDO($row);
    }

    // 🩸 Le héros est-il mort ?
    public function isDead(): bool
    {
        return $this->pv <= 0;
    }

    // 🎲 Jet d'initiative
    public function rollInitiative(): int
    {
        return rand(1, 6) + $this->initiative;
    }

    // 💥 Infliger des dégâts
    public function takeDamage(int $damage): void
    {
        $this->pv -= $damage;
        if ($this->pv < 0) {
            $this->pv = 0;
        }
    }

    // 💊 Soigner le héros
    public function heal(int $amount): void
    {
        $this->pv += $amount;
    }

    // ⚡ Utiliser du mana
    public function useMana(int $amount): bool
    {
        if ($this->mana >= $amount) {
            $this->mana -= $amount;
            return true;
        }
        return false;
    }

    // 🧙 Ajouter un sort à la liste (texte séparé par virgules)
    public function addSpell(string $spell): void
    {
        if ($this->spell_list) {
            $this->spell_list .= ',' . $spell;
        } else {
            $this->spell_list = $spell;
        }
    }

    // 🔄 Convertir en tableau
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'class_id' => $this->class_id,
            'image' => $this->image,
            'biography' => $this->biography,
            'pv' => $this->pv,
            'mana' => $this->mana,
            'strength' => $this->strength,
            'initiative' => $this->initiative,
            'armor_item_id' => $this->armor_item_id,
            'primary_weapon_item_id' => $this->primary_weapon_item_id,
            'secondary_weapon_item_id' => $this->secondary_weapon_item_id,
            'shield_item_id' => $this->shield_item_id,
            'spell_list' => $this->spell_list,
            'xp' => $this->xp,
            'current_level' => $this->current_level,
        ];
    }


    public function chooseAction(): string
    {
        // Exemple basique pour déterminer l'action
        if ($this->class_id == 3 && $this->mana > 0) { // Magicien
            return rand(0, 1) ? 'magie' : 'physique';
        } elseif ($this->class_id == 2 && $this->mana > 0) { // Voleur avec mana
            return rand(0, 1) ? 'magie' : 'physique';
        }
        return 'physique'; // Guerrier ou par défaut
    }
}
