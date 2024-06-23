<?php
$type = 'mysql';
$server = 'localhost';
$db = 'cms';
$port = '';
$charset = 'utf8mb4';

$username = 'admin';
$password = 'password';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
    // include 'database-troubleshooting.php';
}

// TODO: Add unique constraint to category name, user email, article title