// Charts initialization
document.addEventListener('DOMContentLoaded', function () {
  // Skills distribution chart
  const skillsCtx = document.getElementById('skillsChart').getContext('2d');
  new Chart(skillsCtx, {
    type: 'doughnut',
    data: {
      labels: [
        'Développement',
        'Design',
        'Marketing',
        'Data Science',
        'DevOps',
      ],
      datasets: [
        {
          data: [30, 20, 15, 25, 10],
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

  // Progress chart
  const progressCtx = document.getElementById('progressChart').getContext('2d');
  new Chart(progressCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [
        {
          label: 'Stages trouvés',
          data: [10, 25, 35, 50, 65, 75],
          borderColor: '#3b82f6',
          tension: 0.4,
          fill: true,
          backgroundColor: 'rgba(59, 130, 246, 0.1)',
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
          max: 100,
          ticks: {
            callback: function (value) {
              return value + '%';
            },
          },
        },
      },
    },
  });

  // Placement trend chart
  const placementTrendCtx = document
    .getElementById('placementTrendChart')
    .getContext('2d');
  new Chart(placementTrendCtx, {
    type: 'line',
    data: {
      labels: ['Sept', 'Oct', 'Nov', 'Déc', 'Jan', 'Fév', 'Mar', 'Avr'],
      datasets: [
        {
          label: '2024',
          data: [10, 25, 35, 50, 65, 75, 82, 88],
          borderColor: '#3b82f6',
          tension: 0.4,
        },
        {
          label: '2023',
          data: [8, 20, 30, 45, 60, 70, 78, 85],
          borderColor: '#94a3b8',
          tension: 0.4,
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
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          ticks: {
            callback: function (value) {
              return value + '%';
            },
          },
        },
      },
    },
  });

  // Sector distribution chart
  const sectorCtx = document.getElementById('sectorChart').getContext('2d');
  new Chart(sectorCtx, {
    type: 'pie',
    data: {
      labels: ['Tech', 'Finance', 'Marketing', 'Conseil', 'Autres'],
      datasets: [
        {
          data: [40, 20, 15, 15, 10],
          backgroundColor: [
            '#3b82f6',
            '#10b981',
            '#f59e0b',
            '#6366f1',
            '#94a3b8',
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

  // Duration chart
  const durationCtx = document.getElementById('durationChart').getContext('2d');
  new Chart(durationCtx, {
    type: 'bar',
    data: {
      labels: ['3 mois', '4 mois', '5 mois', '6 mois'],
      datasets: [
        {
          label: 'Nombre de stages',
          data: [5, 15, 25, 55],
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
    },
  });

  // Conversion chart
  const conversionCtx = document
    .getElementById('conversionChart')
    .getContext('2d');
  new Chart(conversionCtx, {
    type: 'bar',
    data: {
      labels: [
        'Candidatures envoyées',
        'Entretiens',
        'Offres reçues',
        'Stages acceptés',
      ],
      datasets: [
        {
          label: 'Nombre',
          data: [100, 45, 20, 15],
          backgroundColor: ['#94a3b8', '#3b82f6', '#10b981', '#f59e0b'],
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
    },
  });
});

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

// Company Modal
document
  .getElementById('addCompany')
  .addEventListener('click', () => openModal('companyModal'));
document.querySelectorAll('.edit-company').forEach((btn) => {
  btn.addEventListener('click', () => openModal('companyModal'));
});

// Internship Modal
document
  .getElementById('addInternship')
  .addEventListener('click', () => openModal('internshipModal'));
document.querySelectorAll('.edit-internship').forEach((btn) => {
  btn.addEventListener('click', () => openModal('internshipModal'));
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

// Delete confirmation
document.querySelectorAll('.delete-company').forEach((btn) => {
  btn.addEventListener('click', function () {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')) {
      const card = this.closest('.company-card');
      card.remove();
    }
  });
});

document.querySelectorAll('.delete-internship').forEach((btn) => {
  btn.addEventListener('click', function () {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette offre de stage ?')) {
      const card = this.closest('.internship-card');
      card.remove();
    }
  });
});

// Form submission
document.getElementById('companyForm').addEventListener('submit', function (e) {
  e.preventDefault();
  // TODO: Handle company form submission
  closeModal('companyModal');
});

document
  .getElementById('internshipForm')
  .addEventListener('submit', function (e) {
    e.preventDefault();
    // TODO: Handle internship form submission
    closeModal('internshipModal');
  });

// Notifications popup (to be implemented)
document.querySelector('.notifications').addEventListener('click', function () {
  // TODO: Implement notifications popup
  console.log('Notifications clicked');
});

// Profile menu (to be implemented)
document.querySelector('.profile').addEventListener('click', function () {
  // TODO: Implement profile menu
  console.log('Profile clicked');
});

// Search functionality (to be implemented)
document
  .querySelector('.search-bar input')
  .addEventListener('input', function (e) {
    // TODO: Implement search functionality
    console.log('Search:', e.target.value);
  });

// Message input handling
const messageInput = document.querySelector('.message-input input');
const sendButton = document.querySelector('.send-btn');

function sendMessage() {
  const message = messageInput.value.trim();
  if (message) {
    const messagesContainer = document.querySelector('.messages');
    const newMessage = document.createElement('div');
    newMessage.className = 'message sent';
    newMessage.innerHTML = `
              <p>${message}</p>
              <span class="time">${new Date()
                .toLocaleTimeString()
                .slice(0, 5)}</span>
          `;
    messagesContainer.appendChild(newMessage);
    messageInput.value = '';
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }
}

sendButton.addEventListener('click', sendMessage);
messageInput.addEventListener('keypress', function (e) {
  if (e.key === 'Enter') {
    sendMessage();
  }
});
