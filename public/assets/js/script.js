// Mobile Menu
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');

mobileMenuBtn?.addEventListener('click', () => {
  navLinks?.classList.toggle('active');
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
