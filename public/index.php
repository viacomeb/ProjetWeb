<?php
// Liste des pages autorisées
$pages_valides = ['pages/home', 'offres', 'entreprises', 'services']; // Ajoute les pages autorisées ici

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

    <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime("assets/css/style.css") ?>">
    <?php
    $page_css = "assets/css/$page.css";
    if (file_exists($page_css)) {
        echo '<link rel="stylesheet" href="assets/css/' . $page . '.css?v=' . filemtime($page_css) . '">';
    }
    ?>
</head>


<body>

    <?php include '../src/View/templates/header.php'; ?>

    <main>
        <?php
        // Inclusion sécurisée du fichier correspondant
        $file = "../src/View/$page.php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<p style='text-align: center; color: red; margin-top: 150px; margin-bottom: 120px;'>La page demandée n'existe pas.</p>";
        }
        ?>
    </main>

    <?php include '../src/View/templates/footer.php'; ?>

</body>


</html>
