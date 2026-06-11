<?php
require_once __DIR__ . '/config/database.php';
$db = getDB();
$db->exec("UPDATE projets SET description = REPLACE(description, ' pour un montant de 262 889 361 FCFA', '') WHERE description LIKE '%262 889 361%'");
$db->exec("UPDATE projets SET montant = NULL WHERE montant IS NOT NULL");
echo "OK - montant supprimé";
