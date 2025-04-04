document.addEventListener('DOMContentLoaded', function () {
  // Toggle password visibility
  const togglePassword = document.querySelector('.toggle-password');
  const passwordInput = document.querySelector('#password');

  if (togglePassword && passwordInput) {
    togglePassword.addEventListener('click', function () {
      const type =
        passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.classList.toggle('show');
    });
  }

  // Form submission for loginForm
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    const messageContainer = document.getElementById('messageContainer');
    const errorContainer = document.createElement('div');
    errorContainer.classList.add('alert', 'alert-danger');
    errorContainer.style.display = 'none';
    loginForm.prepend(errorContainer); // Ajouter le conteneur d'erreurs au début du formulaire

    loginForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      // Réinitialiser les messages
      messageContainer.style.display = 'none';
      messageContainer.className = 'alert';
      messageContainer.innerHTML = '';

      const formData = new FormData(loginForm);
      try {
        const response = await fetch(loginForm.action, {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')
              .value,
          },
          body: formData,
        });

        const rawResponseText = await response.text(); // Get raw response text
        console.log('Raw response:', rawResponseText); // Log raw response for debugging

        let result;
        try {
          result = JSON.parse(rawResponseText); // Attempt to parse JSON
        } catch (err) {
          throw new Error('Invalid JSON response from server.');
        }

        if (response.ok) {
          if (result.success) {
            // Afficher le message de succès
            messageContainer.style.display = 'block';
            messageContainer.classList.add('alert-success');
            messageContainer.textContent = 'Vous allez être redirigé...';
            setTimeout(() => {
              window.location.href = result.redirect;
            }, 2000);
          } else {
            // Afficher le message d'erreur
            messageContainer.style.display = 'block';
            messageContainer.classList.add('alert-danger');
            messageContainer.textContent =
              result.message || 'Mauvais email ou mot de passe';
          }
        } else {
          // Gestion des erreurs HTTP
          messageContainer.style.display = 'block';
          messageContainer.classList.add('alert-danger');
          if (result.errors) {
            Object.values(result.errors).forEach((error) => {
              const errorItem = document.createElement('p');
              errorItem.textContent = error;
              messageContainer.appendChild(errorItem);
            });
          } else {
            messageContainer.textContent = 'Mauvais mail / password';
          }
        }
      } catch (error) {
        // Handle network or parsing errors
        messageContainer.style.display = 'block';
        messageContainer.classList.add('alert-danger');
        messageContainer.textContent =
          'Une erreur est survenue. Veuillez réessayer.';
        console.error(error);
      }
    });
  }

  // Form submission for registerForm
  const registerForm = document.getElementById('registerForm');
  if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
      e.preventDefault();
      // Add your registration logic here
      console.log('Register form submitted');
    });
  }
});
