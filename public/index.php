<?php
// Inclusion de la sécurité
include_once '../config/security.php';

// Fonction pour récupérer les pages valides
function getAllowedPages($directory = "../src/View")
{
    $pages_valides = [];

    // Parcourir récursivement les fichiers dans le dossier View/
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    foreach ($iterator as $file) {
        if ($file->isDir()) continue;

        // Récupérer le chemin relatif sans extension
        $relativePath = str_replace([$directory . DIRECTORY_SEPARATOR, ".php"], "", $file->getPathname());
        $relativePath = str_replace(DIRECTORY_SEPARATOR, "/", $relativePath);

        // Ajouter à la liste des pages valides
        $pages_valides[] = $relativePath;
    }
    return $pages_valides;
}

// Liste des pages autorisées
$pages_valides = getAllowedPages();

// Récupération et déchiffrement de la page demandée
$page = isset($_GET['page']) ? decryptPage($_GET['page']) : 'pages/home';

$file = "../src/View/" . $page . ".php";

// Vérification si la page est valide
$isValidPage = in_array($page, $pages_valides);

// Déterminer quelle page inclure
if (!$isValidPage) {
    $file = '../src/View/erreurs/404.php'; // Page 404 si la page n'est pas autorisée
} elseif (!file_exists($file) || filesize($file) == 0) {
    $file = '../src/View/erreurs/maintenance.php'; // Page maintenance si vide ou manquante
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorknGo - <?= ucfirst($page); ?></title>
    <link rel="icon" href="assets/images/WorknGo_logo.svg">

    <!-- Toujours inclure le fichier CSS général -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime("assets/css/style.css") ?>">

    <?php
    $page_file = basename($page);
    $page_css = "assets/css/$page_file.css";

    if (!empty($page_file) && file_exists($page_css)) {
        echo '<link rel="stylesheet" href="' . $page_css . '?v=' . filemtime($page_css) . '">';
    }
    ?>
</head>

<body>

    <?php include '../src/View/templates/header.php';
    ?>

    <main>
        <?php include $file; ?>
    </main>

    <?php include '../src/View/templates/footer.php';
    ?>

</body>

</html>
