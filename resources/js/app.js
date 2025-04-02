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
