<?php
require 'db.php';

header('Content-Type: application/json; charset=utf-8');

$name  = trim($_POST['name']  ?? '');
$fruit = trim($_POST['fruit'] ?? '');
$count = (int)($_POST['count'] ?? 0);

if (!$name || !$fruit || $count < 1) {
    echo json_encode(['success' => false, 'message' => 'Barcha maydonlarni to\'ldiring']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO daraxtlar (daraxt_nomi, meva_turi, meva_soni) VALUES (?, ?, ?)");
    $stmt->execute([$name, $fruit, $count]);
    echo json_encode(['success' => true, 'id' => (int)$pdo->lastInsertId()]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
