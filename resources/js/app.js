// Mobile Menu
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');
const body = document.body;

mobileMenuBtn?.addEventListener('click', () => {
  mobileMenuBtn.classList.toggle('active');
  navLinks?.classList.toggle('active');
  body.style.overflow = navLinks?.classList.contains('active') ? 'hidden' : '';
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
  if (
    navLinks?.classList.contains('active') &&
    !e.target.closest('.nav-links') &&
    !e.target.closest('.mobile-menu-btn')
  ) {
    mobileMenuBtn?.classList.remove('active');
    navLinks?.classList.remove('active');
    body.style.overflow = '';
  }
});

// Close menu when clicking on a link
document.querySelectorAll('.nav-link').forEach((link) => {
  link.addEventListener('click', () => {
    mobileMenuBtn?.classList.remove('active');
    navLinks?.classList.remove('active');
    body.style.overflow = '';
  });
});

// Chatbot Button
const chatbotButton = document.querySelector('.chatbot-button');
chatbotButton?.addEventListener('click', () => {
  // Add chatbot functionality here
  console.log('Chatbot clicked');
});
