<?php
$pageTitle = "StageFlow - Connexion";
?>

<div class="auth-container">
    <div class="auth-card">
        <h2>Inscription</h2>
        <form id="registerForm" class="auth-form">
            <div class="form-group">
                <label for="fullname">Nom complet</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-input">
                    <input type="password" id="password" name="password" required>
                    <button type="button" class="toggle-password">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>
                <div class="password-strength" id="passwordStrength"></div>
            </div>
            <div class="form-group">
                <label for="userType">Je suis</label>
                <div class="user-type-toggle">
                    <input type="radio" id="student" name="userType" value="student" checked>
                    <label for="student">Étudiant</label>
                    <input type="radio" id="company" name="userType" value="company">
                    <label for="company">Entreprise</label>
                </div>
            </div>
            <div class="form-group">
                <label class="terms-checkbox">
                    <input type="checkbox" name="terms" required>
                    <span>J'accepte les <a href="#" class="terms-link">conditions d'utilisation</a> et la <a href="#" class="terms-link">politique de confidentialité</a></span>
                </label>
            </div>
            <button type="submit" class="btn btn-secondary">
                Créer mon compte
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </button>
        </form>
        <div class="auth-separator">
            <span>ou</span>
        </div>
        <p class="auth-redirect">
            Déjà inscrit ? <a href="connexion.php">Connectez-vous</a>
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

        // Password strength indicator
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            passwordStrength.className = 'password-strength';
            const passwordInputWrapper = document.querySelector('.password-input');

            switch (strength) {
                case 0:
                case 1:
                    passwordStrength.classList.add('weak');
                    passwordStrength.textContent = 'Faible';
                    passwordInputWrapper.classList.add('weak');
                    passwordInputWrapper.classList.remove('medium', 'strong');
                    break;
                case 2:
                case 3:
                    passwordStrength.classList.add('medium');
                    passwordStrength.textContent = 'Moyen';
                    passwordInputWrapper.classList.add('medium');
                    passwordInputWrapper.classList.remove('weak', 'strong');
                    break;
                case 4:
                case 5:
                    passwordStrength.classList.add('strong');
                    passwordStrength.textContent = 'Fort';
                    passwordInputWrapper.classList.add('strong');
                    passwordInputWrapper.classList.remove('weak', 'medium');
                    break;
            }
        });


        // Form submission
        const registerForm = document.getElementById('registerForm');
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your registration logic here
            console.log('Register form submitted');
        });
    });
</script>
