<?php
require __DIR__ . '/config.php';

$ok = $pdo->query('SELECT COUNT(*) AS c FROM admin_users')->fetch();
echo "DB connected. Admin users: " . (int)$ok['c'];
