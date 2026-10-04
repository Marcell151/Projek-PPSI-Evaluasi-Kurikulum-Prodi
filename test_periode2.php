<?php
require 'config/database.php';
$stmt = $pdo->query('SELECT COUNT(*) FROM pengisian WHERE periode_id=2');
echo "Count for periode 2: " . $stmt->fetchColumn() . "\n";
?>
