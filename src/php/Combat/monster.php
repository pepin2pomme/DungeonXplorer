<?php

include_once "config.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// --- 1. Charger héros (id=1 pour l'exemple) ---
$stmt = $pdo->prepare("SELECT * FROM Hero h 
                       LEFT JOIN Items armor ON h.armor_item_id = armor.id
                       LEFT JOIN Items primary_weapon ON h.primary_weapon_item_id = primary_weapon.id
                       LEFT JOIN Items secondary_weapon ON h.secondary_weapon_item_id = secondary_weapon.id
                       LEFT JOIN Items shield ON h.shield_item_id = shield.id
                       LEFT JOIN Class c ON h.class_id = c.id
                       WHERE h.id = ?");
$stmt->execute([1]);
$hero = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$hero) die("Héros introuvable !");

// --- 2. Charger un monstre (id=1) ---
$stmt = $pdo->prepare("SELECT * FROM Monster WHERE id = ?");
$stmt->execute([1]);
$monster = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$monster) die("Monstre introuvable !");

// --- 3. Initialisation des PV et mana ---
$hero_hp = $hero['pv'];
$hero_mana = $hero['mana'];
$monster_hp = $monster['pv'] ?? 50;
$monster_mana = $monster['mana'] ?? 0;
$combat_log = [];
$turn = 1;

// --- 4. Fonction pour calculer l'initiative ---
function calcInitiative($attacker, $defender) {
    $att = rand(1, 6) + $attacker['initiative'];
    $def = rand(1, 6) + $defender['initiative'];

    // égalité spéciale pour le Voleur
    if ($att == $def && $attacker['name'] == 'Voleur') $att += 1;

    return [$att, $def];
}

// --- 5. Fonction pour l'attaque physique ---
function attaquePhysique($attaquant, $defenseur, &$def_hp) {
    $bonus_arme = $attaquant['bonus_weapon'] ?? 0; // bonus de l'arme
    $bonus_armure = $defenseur['bonus_armor'] ?? 0;

    $attaque = rand(1, 6) + $attaquant['strength'] + $bonus_arme;

    if ($defenseur['class_id'] == 2) { // Voleur
        $defense = rand(1, 6) + (int)($defenseur['initiative']/2) + $bonus_armure;
    } else {
        $defense = rand(1, 6) + (int)($defenseur['strength']/2) + $bonus_armure;
    }

    $degats = max(0, $attaque - $defense);
    $def_hp -= $degats;

    return $degats;
}

// --- 6. Fonction pour l'attaque magique ---
function attaqueMagique($attaquant, $defenseur, &$def_hp) {
    if ($attaquant['mana'] <= 0) return 0;
    $cout_sort = 2; // exemple fixe
    if ($attaquant['mana'] < $cout_sort) return 0;

    $attaque_magique = (rand(1,6)+rand(1,6)) + $cout_sort;
    $attaquant['mana'] -= $cout_sort;

    $bonus_armure = $defenseur['bonus_armor'] ?? 0;
    $defense = rand(1, 6) + (int)($defenseur['strength']/2) + $bonus_armure;

    $degats = max(0, $attaque_magique - $defense);
    $def_hp -= $degats;

    return $degats;
}

// --- 7. Fonction pour utiliser une potion ---
function utiliserPotion(&$attaquant, $type, $valeur) {
    if ($type === 'pv') {
        $attaquant['pv'] = min($attaquant['pv'] + $valeur, $attaquant['pv_max'] ?? $attaquant['pv']);
    } elseif ($type === 'mana') {
        $attaquant['mana'] = min($attaquant['mana'] + $valeur, $attaquant['mana_max'] ?? $attaquant['mana']);
    }
}

// --- 8. Boucle de combat ---
while($hero_hp > 0 && $monster_hp > 0) {
    $combat_log[] = "=== Tour $turn ===";

    list($hero_init, $monster_init) = calcInitiative($hero, $monster);

    // Déterminer qui attaque
    if ($hero_init > $monster_init || $hero['name'] == 'Voleur' && $hero_init == $monster_init) {
        // Héros attaque
        $degats = attaquePhysique($hero, $monster, $monster_hp);
        $combat_log[] = "Héros inflige $degats dégâts au monstre ! PV monstre restant : ".max(0,$monster_hp);

        if($monster_hp <=0) { $combat_log[] = "Monstre vaincu !"; break; }

        $degats_monstre = attaquePhysique($monster, $hero, $hero_hp);
        $combat_log[] = "Monstre inflige $degats_monstre dégâts au héros ! PV héros restant : ".max(0,$hero_hp);
        if($hero_hp <=0) { $combat_log[] = "Héros vaincu !"; break; }

    } else {
        // Monstre attaque
        $degats_monstre = attaquePhysique($monster, $hero, $hero_hp);
        $combat_log[] = "Monstre inflige $degats_monstre dégâts au héros ! PV héros restant : ".max(0,$hero_hp);
        if($hero_hp <=0) { $combat_log[] = "Héros vaincu !"; break; }

        $degats = attaquePhysique($hero, $monster, $monster_hp);
        $combat_log[] = "Héros inflige $degats dégâts au monstre ! PV monstre restant : ".max(0,$monster_hp);
        if($monster_hp <=0) { $combat_log[] = "Monstre vaincu !"; break; }
    }

    $turn++;
}

// --- 9. Affichage ---
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Combat Héros vs Monstre</title>
<style>
body { font-family: Arial; padding: 20px; }
.log { background:#f4f4f4; padding:10px; margin:5px; border-radius:5px; }
.hero { color: blue; }
.monster { color: red; }
</style>
</head>
<body>
<h1>Combat : <?= htmlspecialchars($hero['name']) ?> vs <?= htmlspecialchars($monster['name']) ?></h1>
<?php foreach($combat_log as $line): ?>
    <div class="log"><?= htmlspecialchars($line) ?></div>
<?php endforeach; ?>
<p><strong>Résultat final :</strong>
<?php
if($hero_hp > 0) echo "<span class='hero'>Héros vainqueur !</span>";
else echo "<span class='monster'>Monstre vainqueur !</span>";
?>
</p>
</body>
</html>
