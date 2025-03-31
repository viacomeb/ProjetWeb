document.addEventListener('DOMContentLoaded', function () {
  // Navigation
  document.querySelectorAll('.nav-links li').forEach((item) => {
    item.addEventListener('click', function () {
      // Remove active class from all items
      document
        .querySelectorAll('.nav-links li')
        .forEach((i) => i.classList.remove('active'));
      // Add active class to clicked item
      this.classList.add('active');

      // Hide all sections
      document.querySelectorAll('.section-content').forEach((section) => {
        section.classList.remove('active');
      });

      // Show selected section
      const sectionId = this.getAttribute('data-section');
      document.getElementById(sectionId).classList.add('active');
    });
  });

  // Charts initialization
  const topCompaniesCtx = document
    .getElementById('topCompaniesChart')
    .getContext('2d');
  new Chart(topCompaniesCtx, {
    type: 'bar',
    data: {
      labels: [
        'TechCorp',
        'DataInsight',
        'WebSolutions',
        'FinTech',
        'MarketPro',
      ],
      datasets: [
        {
          label: 'Nombre de stages',
          data: [25, 18, 15, 12, 10],
          backgroundColor: '#3b82f6',
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false,
        },
      },
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  const domainCtx = document.getElementById('domainChart').getContext('2d');
  new Chart(domainCtx, {
    type: 'doughnut',
    data: {
      labels: [
        'Développement',
        'Data Science',
        'Marketing',
        'Finance',
        'Design',
      ],
      datasets: [
        {
          data: [35, 25, 20, 15, 5],
          backgroundColor: [
            '#3b82f6',
            '#10b981',
            '#f59e0b',
            '#6366f1',
            '#ec4899',
          ],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
        },
      },
    },
  });

  // Filter buttons
  document.querySelectorAll('.filter-btn').forEach((btn) => {
    btn.addEventListener('click', function () {
      // Remove active class from all buttons in the same filter group
      this.parentElement.querySelectorAll('.filter-btn').forEach((b) => {
        b.classList.remove('active');
      });
      // Add active class to clicked button
      this.classList.add('active');
    });
  });

  // Modal Management
  function openModal(modalId) {
    document.getElementById(modalId).classList.add('active');
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
  }

  // Add user buttons
  document.getElementById('addPilot')?.addEventListener('click', () => {
    document.getElementById('userType').value = 'pilot';
    const pilotSection = document.getElementById('pilotSection');
    pilotSection.style.display = 'block'; // Afficher la section
    const studentSection = document.getElementById('studentTutor');
    studentSection.style.display = 'none'; // Masquer la section
    openModal('userModal');
  });

  document.getElementById('addStudent')?.addEventListener('click', () => {
    document.getElementById('userType').value = 'student';
    openModal('userModal');
  });

  // Close buttons
  document.querySelectorAll('.close, .modal-close').forEach((btn) => {
    btn.addEventListener('click', function () {
      const modal = this.closest('.modal');
      if (modal) {
        closeModal(modal.id);
      }
    });
  });

  // Form submission
  document.getElementById('userForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    // TODO: Handle user form submission
    const modal = this.closest('.modal');
    if (modal) {
      closeModal(modal.id);
    }
  });

  // Delete confirmation
  document.querySelectorAll('[title="Supprimer"]').forEach((btn) => {
    btn.addEventListener('click', function () {
      if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
        const row = this.closest('tr');
        if (row) {
          row.remove();
        }
      }
    });
  });

  // Notifications popup (to be implemented)
  document
    .querySelector('.notifications')
    ?.addEventListener('click', function () {
      // TODO: Implement notifications popup
      console.log('Notifications clicked');
    });

  // Profile menu (to be implemented)
  document.querySelector('.profile')?.addEventListener('click', function () {
    // TODO: Implement profile menu
    console.log('Profile clicked');
  });

  // Search functionality (to be implemented)
  document
    .querySelector('.search-bar input')
    ?.addEventListener('input', function (e) {
      // TODO: Implement search functionality
      console.log('Search:', e.target.value);
    });

  // Permission toggles
  document
    .querySelectorAll('.permission input[type="checkbox"]')
    .forEach((checkbox) => {
      checkbox.addEventListener('change', function () {
        // TODO: Handle permission changes
        console.log('Permission changed:', this.checked);
      });
    });

  // Security settings
  document
    .querySelectorAll('.security-settings .switch input')
    .forEach((toggle) => {
      toggle.addEventListener('change', function () {
        // TODO: Handle security setting changes
        console.log('Security setting changed:', this.checked);
      });
    });

  // GDPR actions
  document.querySelectorAll('.gdpr-settings .btn-secondary').forEach((btn) => {
    btn.addEventListener('click', function () {
      // TODO: Handle GDPR actions
      console.log('GDPR action:', this.textContent);
    });
  });
});

// JavaScript pour afficher/masquer la section "Étudiants pris en charge"
document.addEventListener('DOMContentLoaded', function () {
  const userTypeSelect = document.getElementById('userType');
  const pilotSection = document.getElementById('pilotSection');
  const studentSection = document.getElementById('studentTutor');

  userTypeSelect.addEventListener('change', function () {
    if (this.value === 'pilot') {
      pilotSection.style.display = 'block'; // Afficher la section
      studentSection.style.display = 'none';
    } else if (this.value == 'student') {
      pilotSection.style.display = 'none';
      studentSection.style.display = 'block';
    } else {
      pilotSection.style.display = 'none'; // Masquer la section
      studentSection.style.display = 'none';
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const tutorSelect = document.getElementById('studentTutorSelect');

  // Exemple de données des tuteurs (à remplacer par une requête API ou une base de données)
  const tutors = [
    { id: 1, name: 'Jean Martin' },
    { id: 2, name: 'Claire Dupont' },
    { id: 3, name: 'Paul Durand' },
  ];

  // Ajouter les options au champ de sélection
  tutors.forEach((tutor) => {
    const option = document.createElement('option');
    option.value = tutor.id;
    option.textContent = tutor.name;
    tutorSelect.appendChild(option);
  });
});
