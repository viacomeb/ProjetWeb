<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier de connexion à la base de données
require_once __DIR__ . '/config/database.php';

try {
    // Préparer et exécuter la requête SQL pour récupérer tous les utilisateurs
    $stmt = $pdo->query('SELECT * FROM user');
    $users = $stmt->fetchAll();

    echo "<h1>Liste des utilisateurs</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Email</th><th>Role</th></tr>";

    // Afficher les utilisateurs
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user['id']) . "</td>";
        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
        echo "<td>" . htmlspecialchars($user['mot_de_pass']) . "</td>";
        echo "<td>" . htmlspecialchars($user['role']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
}
