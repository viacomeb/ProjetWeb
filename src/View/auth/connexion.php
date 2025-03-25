<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$pageTitle = "StageFlow - Connexion";

// Inclure le fichier de connexion à la base de données
echo "Tentative d'inclusion de database.php...<br>";
require_once __DIR__ . '/../../../config/database.php';
echo "Fichier database.php inclus avec succès.<br>";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "Formulaire soumis.<br>";
    $email = $_POST['email'];
    $password = $_POST['mot_de_pass'];

    echo "Email soumis : " . htmlspecialchars($email) . "<br>";
    echo "Mot de passe soumis : " . htmlspecialchars($password) . "<br>";

    // Préparer et exécuter la requête SQL
    try {
        echo "Préparation de la requête SQL...<br>";
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            echo "Utilisateur trouvé : " . print_r($user, true) . "<br>";
        } else {
            echo "Aucun utilisateur trouvé avec cet email.<br>";
        }

        if ($user && password_verify($password, $user['mot_de_pass'])) {
            echo "Mot de passe vérifié.<br>";
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Rediriger en fonction du rôle de l'utilisateur
            if ($user['role'] === 'admin') {
                echo "Redirection vers le tableau de bord admin...<br>";
                header('Location: /admin/dashboard.php');
            } elseif ($user['role'] === 'pilote') {
                echo "Redirection vers le tableau de bord pilote...<br>";
                header('Location: /pilote/dashboard.php');
            } else {
                echo "Redirection vers le tableau de bord utilisateur...<br>";
                header('Location: /user/dashboard.php');
            }
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
            echo $error . "<br>";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage() . "<br>";
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
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="debug-info" style="background: #1a1a1a; padding: 15px; border-radius: 8px; margin-bottom: 20px; color: #fff; font-family: monospace;">
                    <h3 style="margin-bottom: 10px;">Informations de débogage :</h3>
                    <pre style="white-space: pre-wrap; word-wrap: break-word;">
Email soumis : <?php echo htmlspecialchars($email); ?>
Requête SQL : SELECT * FROM users WHERE email = :email
Paramètres : <?php print_r(['email' => $email]); ?>
Résultat de la requête : <?php print_r($user); ?>
                    </pre>
                </div>
            <?php endif; ?>

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
            // Toggle password visibility
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
                // Add your login logic here
                console.log('Login form submitted');
            });
        });
    </script>
</body>

</html>
