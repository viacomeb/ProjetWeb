<main class="container" style="margin-top: 6rem;">
    <h2>Connexion</h2>
    <form id="loginForm" style="max-width: 400px; margin: auto; background: var(--color-surface); padding: 2rem; border-radius: 0.5rem;">
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
        </div>
        <div style="margin-top: 1rem;">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" required style="width: 100%; padding: 0.5rem; margin-top: 0.5rem;">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 1.5rem; width: 100%;">Se connecter</button>
    </form>
    <br>
    <br>
</main>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        if (email === 'admin@example.com' && password === 'password') {
            alert('Connexion réussie !');
        } else {
            alert('Identifiants incorrects');
        }
    });
</script>
