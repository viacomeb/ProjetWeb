<?php
$host = '127.0.0.1'; // Remplacez par l'hôte de votre serveur de base de données
$db = 'workngo'; // Remplacez par le nom de votre base de données
$user = 'tiago'; // Remplacez par votre nom d'utilisateur de base de données
$pass = 'Tiag0***'; // Remplacez par votre mot de passe de base de données
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connexion réussie à la base de données.<br>";
} catch (\PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage() . "<br>";
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
