<?php
require __DIR__ . '/config.php';


$username = 'Alwis';
$newPlain = 'Alwis123';


$hash = password_hash($newPlain, PASSWORD_DEFAULT);
$sql = 'INSERT INTO admin_users (username, password_hash)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)';
$pdo->prepare($sql)->execute([$username, $hash]);

echo "Admin reset: username='{$username}', password='{$newPlain}'";
echo "<br>Please DELETE this file (reset_admin.php) for security.";
