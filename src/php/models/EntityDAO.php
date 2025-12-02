<?php
class EntityDAO {

    public static function getById($id, $db) {
        $stmt = $db->prepare("SELECT * FROM DUN_ENTITY WHERE ENT_ID = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row ? new Entity($row) : null;
    }

    public static function update($e, $db) {
        $q = $db->prepare("
            UPDATE DUN_ENTITY SET 
                ENT_PV = ?, 
                ENT_MANA = ?
            WHERE ENT_ID = ?
        ");
        $q->execute([$e->pv, $e->mana, $e->id]);
    }
}
?>