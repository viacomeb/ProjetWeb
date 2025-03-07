<?php
require_once __DIR__ . '/../../../config/database.php'; // Inclut la connexion

// Gestion de la pagination
$parPage = 10;
$page = isset($_GET['page']) ? filter_var($_GET['page'], FILTER_VALIDATE_INT) : 1;
if (!$page || $page < 1) $page = 1;

// Récupération du nombre total d'entreprises
$query = $pdo->query("SELECT COUNT(*) AS total FROM Entreprise");
$total = $query->fetch()['total'];
$totalPages = ceil($total / $parPage);
if ($page > $totalPages) $page = $totalPages;

$start = ($page - 1) * $parPage;

// Récupération des entreprises paginées
$stmt = $pdo->prepare("SELECT ID, nom, code_postal, type FROM Entreprise LIMIT :start, :parPage");
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':parPage', $parPage, PDO::PARAM_INT);
$stmt->execute();
$entreprises = $stmt->fetchAll();
?>


<br>
<br>
<table>
    <tr>
        <th>Nom</th>
        <th>Code Postal</th>
        <th>Type</th>
    </tr>
    <?php foreach ($entreprises as $entreprise): ?>
        <tr>
            <td><?= $entreprise['nom']; ?></td>
            <td><?= $entreprise['code_postal']; ?></td>
            <td><?= $entreprise['type']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a class="pagination-button" href="?page=<?= $page - 1; ?>">⬅ Précédent</a>
    <?php endif; ?>
    <span> Page <?= $page; ?> sur <?= $totalPages; ?> </span>
    <?php if ($page < $totalPages): ?>
        <a class="pagination-button" href="?page=<?= $page + 1; ?>">Suivant ➡</a>
    <?php endif; ?>
</div>
