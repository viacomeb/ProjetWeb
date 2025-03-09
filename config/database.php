<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'BDD_Projet_WEB';
$username = 'root'; // Modifie si nécessaire
$password = ''; // Modifie si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>


