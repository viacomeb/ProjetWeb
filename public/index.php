<?php
// Liste des pages autorisées
function getAllowedPages($directory = "../src/View")
{
    $pages_valides = [];

    // Parcourir récursivement les fichiers dans le dossier view/
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    foreach ($iterator as $file) {
        // Ignorer les dossiers
        if ($file->isDir()) continue;

        // Récupérer le chemin relatif sans extension
        $relativePath = str_replace([$directory . DIRECTORY_SEPARATOR, ".php"], "", $file->getPathname());

        // Convertir les séparateurs de chemin en "/"
        $relativePath = str_replace(DIRECTORY_SEPARATOR, "/", $relativePath);

        // Ajouter à la liste des pages valides
        $pages_valides[] = $relativePath;
    }

    return $pages_valides;
}

// Générer et stocker la liste des pages valides
$pages_valides = getAllowedPages();

// Vérification de la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'pages/home';

// Si la page n'est pas valide, afficher un message d'erreur
if (!in_array($page, $pages_valides)) {
    $page = 'erreurs/404'; // Définition d'une page 404
}
?>
<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorknGo - <?php echo ucfirst($page); ?></title>
    <link rel="icon" href="assets/images/WorknGo_logo.svg">

    <!-- Toujours inclure le fichier CSS général -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime("assets/css/style.css") ?>">

    <?php
    // Extraire uniquement le nom du fichier après le "/"
    $page_file = isset($page) ? basename($page) : '';

    // Construire le chemin du fichier CSS spécifique
    $page_css = "assets/css/$page_file.css";

    // Vérifier si le fichier CSS spécifique existe et l'inclure
    if (!empty($page_file) && file_exists($page_css)) {
        echo '<link rel="stylesheet" href="' . $page_css . '?v=' . filemtime($page_css) . '">';
    }
    ?>
</head>


<body>

    <?php include '../src/View/templates/header.php'; ?>

    <main>
        <?php
        // Inclusion sécurisée du fichier correspondant
        $file = "../src/View/$page.php";
        if (file_exists($file) && filesize($file) > 0) {
            include $file;
        } else {
            include '../src/View/erreurs/maintenance.php';
        }
        ?>
    </main>

    <?php include '../src/View/templates/footer.php'; ?>

</body>


</html>
