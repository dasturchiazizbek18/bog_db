<?php
$host    = 'sql304.infinityfree.com';
$db      = 'if0_41922157_bog';
$user    = 'if0_41922157';
$pass    = 'cyF0cE3rir';   // <-- parolingizni yozing
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['success' => false, 'message' => 'DB xato: ' . $e->getMessage()]));
}