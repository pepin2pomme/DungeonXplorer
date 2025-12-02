<?php
class CombatView {

    private $combat;

    public function __construct($combat) {
        $this->combat = $combat;
    }

    public function render() {
        ?>
        <h1>Combat</h1>
        <p>Héros : <?= $this->combat->hero->nom ?> — PV : <?= $this->combat->hero->pv ?>/<?= $this->combat->hero->pvMax ?></p>
        <p>Monstre : <?= $this->combat->monster->nom ?> — PV : <?= $this->combat->monster->pv ?>/<?= $this->combat->monster->pvMax ?></p>

        <hr>

        <?php if (!$this->combat->isFinished()) : ?>
            <form method="POST">
                <button type="submit" name="action" value="attack">Attaquer</button>
                <button type="submit" name="action" value="capacity">Capacité</button>
                <button type="submit" name="action" value="defend">Défendre</button>
            </form>
        <?php else: ?>
            <p><strong>Combat terminé !</strong></p>
        <?php endif; ?>
        <hr>
        <div id="log">
            <?php if (!empty($_SESSION['log'])): ?>
                <?= $_SESSION['log'] ?>
            <?php endif; ?>
        </div>
        <?php
    }

    public function playTurn($action) {
        $log = "";
        if ($action === "attack") {
            $log .= $this->combat->heroAttacks() . "<br>";
            if (!$this->combat->isFinished()) {
                $log .= $this->combat->monsterAttacks() . "<br>";
            }
        }
        $_SESSION['log'] = $log;
    }
}
