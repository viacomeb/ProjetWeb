<?php
$host = 'your_server_host'; // Remplacez par l'hôte de votre serveur de base de données
$db = 'your_database_name'; // Remplacez par le nom de votre base de données
$user = 'your_database_user'; // Remplacez par votre nom d'utilisateur de base de données
$pass = 'your_database_password'; // Remplacez par votre mot de passe de base de données
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
