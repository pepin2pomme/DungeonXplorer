<?php

class CombatAdvanced
{
    public Hero $hero;
    public Monster $monster;
    public array $log = [];

    public function __construct(Hero $hero, Monster $monster)
    {
        $this->hero = $hero;
        $this->monster = $monster;
    }

    // 🔹 Lancer le combat complet
    public function start(): void
    {
        $this->log[] = "⚔️ Combat entre {$this->hero->name} et {$this->monster->name} !";

        while (!$this->hero->isDead() && !$this->monster->isDead()) {
            $this->tourCombat($this->hero, $this->monster);
        }

        if ($this->hero->isDead()) {
            $this->log[] = "💀 {$this->hero->name} a été vaincu !";
        } else {
            $this->hero->xp += $this->monster->xp;
            $this->log[] = "🏆 {$this->hero->name} a vaincu {$this->monster->name} et gagne {$this->monster->xp} XP !";
        }
    }

    // 🔹 Tour de combat
    function tourCombat($attaquant, $defenseur) {
    // Calcul de l'initiative
    $initiativeAttaquant = rand(1, 6) + $attaquant->initiative;
    $initiativeDefenseur = rand(1, 6) + $defenseur->initiative;

    // Détermination de l'attaquant
    if ($initiativeAttaquant >= $initiativeDefenseur || ($attaquant instanceof Hero && $attaquant->class_id == 2)) {
        // L'attaquant choisit son action
        $choix = $attaquant->chooseAction();

        switch ($choix) {
            case 'physique':
                $degats = attaquePhysique($attaquant, $defenseur);
                break;
            case 'magie':
                $degats = attaqueMagique($attaquant, $defenseur);
                break;
            case 'potion':
                utiliserPotion($attaquant);
                $degats = 0; // Pas de dégâts, mais un effet de soin
                break;
        }

        $defenseur->takeDamage($degats);

        if (!$defenseur->isDead()) {
            // Le défenseur riposte s'il est toujours en vie
            $choixDef = $defenseur->chooseAction();
            switch ($choixDef) {
                case 'physique':
                    $degats = attaquePhysique($defenseur, $attaquant);
                    break;
                case 'magie':
                    $degats = attaqueMagique($defenseur, $attaquant);
                    break;
                case 'potion':
                    utiliserPotion($defenseur);
                    $degats = 0;
                    break;
            }

            $attaquant->takeDamage($degats);
        }
    }
}

    // 🔹 Choisir et exécuter une action
    public function executerAction($attaquant, $defenseur): void
    {
        // Pour l'instant, attaque physique par défaut
        $choix = $this->choisirAction($attaquant);

        switch ($choix) {
            case 'physique':
                $degats = $this->attaquePhysique($attaquant, $defenseur);
                $this->log[] = "{$attaquant->name} attaque physiquement et inflige $degats dégâts à {$defenseur->name}.";
                break;

            case 'magie':
                $degats = $this->attaqueMagique($attaquant, $defenseur);
                $this->log[] = "{$attaquant->name} attaque magiquement et inflige $degats dégâts à {$defenseur->name}.";
                break;

            case 'potion':
                $this->utiliserPotion($attaquant);
                $this->log[] = "{$attaquant->name} utilise une potion.";
                break;
        }
    }

    // 🔹 Logique de choix d'action (simple pour l'instant)
    public function choisirAction($attaquant): string
    {
        // Si Magicien et mana > 0, 50% chance de lancer sort
        if ($attaquant instanceof Hero && $attaquant->class_id === 3 && $attaquant->mana > 0 && rand(0, 1) === 1) {
            return 'magie';
        }

        // Si PV bas et potion disponible, boire
        // TODO : gérer inventaire
        return 'physique';
    }

    // 🔹 Attaque physique
   
    function attaquePhysique($attaquant, $defenseur) {
        $attaque = rand(1, 6) + $attaquant->strength;
        $bonusArme = $attaquant->primary_weapon_item_id ? 2 : 0;
        $defense = rand(1, 6) + (int)($defenseur->strength / 2);
        $bonusArmure = $defenseur->armor_item_id ? 2 : 0;
        $defense += $bonusArmure;

        $degats = max(0, $attaque + $bonusArme - $defense);
        return $degats;
}
    

    // 🔹 Attaque magique
    public function attaqueMagique($attaquant, $defenseur) : int
    {
        $coutSort = 3; // Exemple d'un coût fixe pour les sorts
        if ($attaquant->mana < $coutSort) return 0;

        $attaqueMagique = rand(1, 6) + rand(1, 6) + $coutSort;
        $attaquant->useMana($coutSort);

        $defense = rand(1, 6) + (int)($defenseur->strength / 2);
        $bonusArmure = $defenseur->armor_item_id ? 2 : 0;
        $defense += $bonusArmure;

        $degats = max(0, $attaqueMagique - $defense);
        return $degats;
    }

    // 🔹 Utilisation de potion (simplifiée)
    public function utiliserPotion($attaquant): void
    {
        // Exemple : +10 PV ou mana
        $attaquant->pv += 10;
        $attaquant->mana += 5;

        // TODO : vérifier max PV / mana
    }
}

