// Mobile Menu
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const mobileMenu = document.querySelector('.mobile-menu');

mobileMenuBtn.addEventListener('click', () => {
  mobileMenu.classList.toggle('active');
});

// Fermer le menu si on clique ailleurs sur la page
document.addEventListener('click', (event) => {
  if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
    mobileMenu.classList.remove('active');
  }
});



// Chatbot Button
const chatbotButton = document.querySelector('.chatbot-button');
chatbotButton?.addEventListener('click', () => {
  // Add chatbot functionality here
  console.log('Chatbot clicked');
});

// Login Form
document.getElementById('loginForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  // Check if email and password are correct
  if (email === 'admin@example.com' && password === 'password') {
      alert('Connexion réussie !');
  } else {
      alert('Identifiants incorrects');
  }
});
