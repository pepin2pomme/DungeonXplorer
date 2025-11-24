class Hero{
    public let id ,
    name VARCHAR(50) NOT NULL,
    class_id INT, -- Relation avec Class
    image VARCHAR(255),
    biography TEXT,
    pv INT NOT NULL,
    mana INT NOT NULL,
    strength INT NOT NULL,
    initiative INT NOT NULL,
    
    armor_item_id INT,
    primary_weapon_item_id INT,
    secondary_weapon_item_id INT,
    shield_item_id INT,
    
    spell_list TEXT,
    xp INT NOT NULL,
    current_level INT DEFAULT 1,
}