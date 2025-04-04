document.addEventListener('DOMContentLoaded', function () {
  // Search functionality
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('input', function (e) {
    // Implement search logic here
    console.log('Searching for:', e.target.value);
  });

  // Favorite button functionality
  const favoriteButtons = document.querySelectorAll('.favorite-button');
  favoriteButtons.forEach((button) => {
    button.addEventListener('click', function () {
      this.classList.toggle('active');
      const icon = this.querySelector('[data-lucide="star"]');
      if (this.classList.contains('active')) {
        icon.style.fill = '#EAB308';
      } else {
        icon.style.fill = 'none';
      }
    });
  });

  // Apply button functionality
  const applyButtons = document.querySelectorAll('.apply-button');
  applyButtons.forEach((button) => {
    button.addEventListener('click', function () {
      // Animation de clic
      this.style.transform = 'scale(0.95)';
      setTimeout(() => {
        this.style.transform = 'scale(1)';
      }, 100);

      // Simuler une candidature
      this.textContent = 'Candidature envoyée !';
      this.style.backgroundColor = '#22C55E';
      this.disabled = true;
    });
  });

  // Hover effects for cards
  const cards = document.querySelectorAll('.internship-card, .badge-card');
  cards.forEach((card) => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-2px)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
    });
  });

  // Notification system simulation
  const notificationButton =
    document.querySelector('.notification-dot').parentElement;
  notificationButton.addEventListener('click', function () {
    alert(
      'Notifications : \n- Une entreprise a consulté votre profil\n- Nouveau stage recommandé disponible'
    );
  });
});
