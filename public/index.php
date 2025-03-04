<?php
// Liste des pages autorisées
$pages_valides = ['home', 'contact', 'about', 'services']; // Ajoute les pages autorisées ici

// Récupération et validation de la page demandée
$page = isset($_GET['page']) && in_array($_GET['page'], $pages_valides) ? $_GET['page'] : 'index';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorknGo - <?php echo ucfirst($page); ?></title>
    <!-- Logo de l'onglet -->
    <link rel="icon" href="../public/assets/images/WorknGo_logo.svg">
    <!-- Chargement dynamique du CSS -->
    <link rel="stylesheet" href="../public/assets/css/style.css"> <!-- CSS général -->
    <link rel="stylesheet" href="css/<?php echo file_exists("css/$page.css") ? $page : 'style'; ?>.css">
</head>

<body>

    <?php include '../src/View/layout/header.php'; ?>

    <main>
        <?php
        // Inclusion sécurisée du fichier correspondant
        $file = "../public/$page.php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<p style='text-align: center; color: red; margin-top: 150px; margin-bottom: 120px;'>La page demandée n'existe pas.</p>";
        }
        ?>
    </main>

    <?php include '../src/View/layout/footer.php'; ?>

</body>

</html>
