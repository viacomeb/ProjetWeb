<?php

session_start();
$pageTitle = "StageFlow - Connexion";

// Inclure le fichier de connexion à la base de données

require_once __DIR__ . '/../../../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['mot_de_pass'];
    // Préparer et exécuter la requête SQL
    try {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();


        // Comparer les mots de passe en clair (non recommandé)
        if ($user && $password === $user['mot_de_pass']) {

            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Rediriger en fonction du rôle de l'utilisateur
            if ($user['role'] === 'company') {
                header('Location: ../../../index.php?page=' . urlencode(encryptPage("entreprises/dashboard")));
                exit;
            } elseif ($user['role'] === 'pilote') {
                header('Location: ../../../index.php?page=' . urlencode(encryptPage("pilotes/dashboard")));
                exit;
            } else {
                header('Location: ../../../index.php?page=' . urlencode(encryptPage("etudiants/dashboard")));
                exit;
            }
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $error = "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link rel="stylesheet" href="/public/assets/css/pilotes_dashboard.css">
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <h2>Connexion</h2>
            <form id="loginForm" class="auth-form" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="password-input">
                        <input type="password" id="password" name="mot_de_pass" required>
                        <button type="button" class="toggle-password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    <?php if (!empty($error)): ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-footer">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn btn-secondary">
                    Se connecter
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
            <div class="auth-separator">
                <span>ou</span>
            </div>
            <p class="auth-redirect">
                Pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('#password');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('show');
            });

            // Form submission
            const loginForm = document.getElementById('loginForm');
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                loginForm.submit(); // Submit the form
            });
        });
    </script>
</body>

</html>
