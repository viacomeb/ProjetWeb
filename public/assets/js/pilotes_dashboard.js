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

  const internshipModal = document.getElementById('internshipDetailsModal');
  const internshipModalTitle = document.getElementById('internshipModalTitle');
  const internshipModalCompany = document.getElementById(
    'internshipModalCompany'
  );
  const internshipModalDescription = document.getElementById(
    'internshipModalDescription'
  );
  const internshipModalDuration = document.getElementById(
    'internshipModalDuration'
  );
  const internshipModalSkills = document.getElementById(
    'internshipModalSkills'
  );

  document.querySelectorAll('.internship-card').forEach((card) => {
    card.addEventListener('click', (event) => {
      // Prevent modal from opening if the "Modifier" or "Supprimer" button is clicked
      if (
        event.target.closest('.edit-internship') ||
        event.target.closest('.delete-internship')
      ) {
        return;
      }

      const title = card.querySelector('h3').textContent;
      const company = card.querySelector('.company-name').textContent;
      const description = card.querySelector('.description').textContent;
      const duration = card.querySelector(
        '.tags .tag:nth-child(3)'
      ).textContent;
      const skills = Array.from(card.querySelectorAll('.tags .tag'))
        .slice(0, -1)
        .map((tag) => tag.textContent)
        .join(', ');

      internshipModalTitle.textContent = title;
      internshipModalCompany.textContent = company;
      internshipModalDescription.textContent = description;
      internshipModalDuration.textContent = duration;
      internshipModalSkills.textContent = skills;

      internshipModal.classList.add('active');
    });
  });

  document.querySelectorAll('#internshipDetailsModal .close').forEach((btn) => {
    btn.addEventListener('click', () => {
      internshipModal.classList.remove('active');
    });
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

document.querySelectorAll('.edit-internship').forEach((btn) => {
  btn.addEventListener('click', function () {
    const internshipCard = this.closest('.internship-card');
    if (!internshipCard) return;

    // Extract existing details from the internship card
    const title = internshipCard.querySelector('h3').textContent;
    const company = internshipCard.querySelector('.company-name').textContent;
    const description =
      internshipCard.querySelector('.description').textContent;
    const duration = internshipCard
      .querySelector('.tags .tag:nth-child(3)')
      .textContent.replace(' mois', '');
    const skills = Array.from(internshipCard.querySelectorAll('.tags .tag'))
      .slice(0, -1)
      .map((tag) => tag.textContent)
      .join(', ');

    // Pre-fill the form fields with the extracted details
    document.getElementById('internshipTitle').value = title;
    document.getElementById('internshipCompany').value = company;
    document.getElementById('internshipDescription').value = description;
    document.getElementById('internshipDuration').value = duration;
    document.getElementById('internshipSkills').value = skills;

    // Open the internship modal
    openModal('internshipModal');
  });
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

// Close modal when clicking outside of it
document.querySelectorAll('.modal').forEach((modal) => {
  modal.addEventListener('click', function (event) {
    if (event.target === modal) {
      modal.classList.remove('active');
    }
  });
});

let internshipToDelete = null;

document.querySelectorAll('.delete-internship').forEach((btn) => {
  btn.addEventListener('click', function () {
    const internshipCard = this.closest('.internship-card');
    if (!internshipCard) return;

    internshipToDelete = internshipCard; // Store the card to delete
    openModal('deleteConfirmationModal'); // Open the confirmation modal
  });
});

document.getElementById('confirmDelete').addEventListener('click', () => {
  if (internshipToDelete) {
    internshipToDelete.remove(); // Remove the internship card
    internshipToDelete = null; // Reset the reference
    closeModal('deleteConfirmationModal'); // Close the modal
  }
});

// Close modal when clicking the "Annuler" button
document.querySelectorAll('#deleteConfirmationModal .close').forEach((btn) => {
  btn.addEventListener('click', () => {
    internshipToDelete = null; // Reset the reference
    closeModal('deleteConfirmationModal');
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

const companyDetailsModal = document.getElementById('companyDetailsModal');
const companyModalTitle = document.getElementById('companyModalTitle');
const companyModalDescription = document.getElementById(
  'companyModalDescription'
);
const companyModalPhone = document.getElementById('companyModalPhone');
const companyModalEmail = document.getElementById('companyModalEmail');
const companyModalAddress = document.getElementById('companyModalAddress');
const starRating = document.querySelector('.star-rating');
const ratingValue = document.getElementById('ratingValue');

// Function to update the star display
function updateStarDisplay(rating) {
  const stars = starRating.querySelectorAll('i');
  stars.forEach((star) => {
    const starValue = parseInt(star.getAttribute('data-value'), 10);
    if (starValue <= rating) {
      star.classList.remove('far');
      star.classList.add('fas', 'full');
    } else {
      star.classList.remove('fas', 'full');
      star.classList.add('far');
    }
  });
}

// Handle star rating click
if (starRating && ratingValue) {
  starRating.addEventListener('click', (event) => {
    const star = event.target.closest('i');
    if (star) {
      const rating = parseInt(star.dataset.value, 10);
      ratingValue.textContent = `Note : ${rating}/5`; // Update to show "x/5"
      updateStarDisplay(rating);
      console.log(`Entreprise notée avec ${rating}/5 étoiles.`);
    }
  });
}

// Function to close all active modals
function closeAllModals() {
  document.querySelectorAll('.modal.active').forEach((modal) => {
    modal.classList.remove('active');
  });
}

// Open company details modal
document.querySelectorAll('.company-card').forEach((card) => {
  card.addEventListener('click', (event) => {
    // Prevent modal from opening if a button inside the card is clicked
    if (event.target.closest('button')) {
      return;
    }

    // Close any previously active modals
    closeAllModals();

    const companyName = card
      .querySelector('.company-info h3')
      .textContent.trim();

    // Simulate fetching company details
    const companyDetails = {
      name: companyName,
      description: `Description de l'entreprise ${companyName}.`,
      phone: '+33 1 23 45 67 89',
      email: `${companyName.toLowerCase().replace(/\s+/g, '')}@example.com`,
      address: '123 Rue de Paris, 75000 Paris, France',
    };

    // Populate modal with company details
    companyModalTitle.textContent = companyDetails.name;
    companyModalDescription.textContent = companyDetails.description;
    companyModalPhone.textContent = companyDetails.phone;
    companyModalEmail.textContent = companyDetails.email;
    companyModalAddress.textContent = companyDetails.address;

    // Show modal
    companyDetailsModal.classList.add('active');
  });
});

// Close modal
document.querySelectorAll('#companyDetailsModal .close').forEach((btn) => {
  btn.addEventListener('click', () => {
    companyDetailsModal.classList.remove('active');
  });
});

// Close modal when clicking outside of it
companyDetailsModal.addEventListener('click', (event) => {
  if (event.target === companyDetailsModal) {
    companyDetailsModal.classList.remove('active');
  }
});

const editCompanyModal = document.getElementById('editCompanyModal');
const editCompanyForm = document.getElementById('editCompanyForm');
const editCompanyName = document.getElementById('editCompanyName');
const editCompanySector = document.getElementById('editCompanySector');
const editCompanyDescription = document.getElementById(
  'editCompanyDescription'
);
const editCompanyWebsite = document.getElementById('editCompanyWebsite');
let companyToEdit = null;

// Open company edit modal
document.querySelectorAll('.edit-company').forEach((btn) => {
  btn.addEventListener('click', function () {
    const companyCard = this.closest('.company-card');
    if (!companyCard) return;

    // Close any previously active modals
    closeAllModals();

    companyToEdit = companyCard; // Store the card being edited

    // Extract existing details from the company card
    const name = companyCard.querySelector('.company-info h3').textContent;
    const sector = companyCard.querySelector('.company-info p').textContent;
    const description =
      companyCard.querySelector('.company-description')?.textContent || '';
    const website =
      companyCard.querySelector('.company-website')?.textContent || '';

    // Pre-fill the form fields with the extracted details
    editCompanyName.value = name;
    editCompanySector.value = sector;
    editCompanyDescription.value = description;
    editCompanyWebsite.value = website;

    // Open the company edit modal
    editCompanyModal.classList.add('active');
  });
});

// Handle company edit form submission
editCompanyForm.addEventListener('submit', function (e) {
  e.preventDefault();
  if (!companyToEdit) return;

  // Update the company card with the new details
  companyToEdit.querySelector('.company-info h3').textContent =
    editCompanyName.value;
  companyToEdit.querySelector('.company-info p').textContent =
    editCompanySector.value;
  if (companyToEdit.querySelector('.company-description')) {
    companyToEdit.querySelector('.company-description').textContent =
      editCompanyDescription.value;
  }
  if (companyToEdit.querySelector('.company-website')) {
    companyToEdit.querySelector('.company-website').textContent =
      editCompanyWebsite.value;
  }

  // Close the modal
  editCompanyModal.classList.remove('active');
  companyToEdit = null; // Reset the reference
});

// Close modal when clicking the "Annuler" button or outside the modal
document.querySelectorAll('#editCompanyModal .close').forEach((btn) => {
  btn.addEventListener('click', () => {
    editCompanyModal.classList.remove('active');
    companyToEdit = null; // Reset the reference
  });
});

editCompanyModal.addEventListener('click', (event) => {
  if (event.target === editCompanyModal) {
    editCompanyModal.classList.remove('active');
    companyToEdit = null; // Reset the reference
  }
});

let companyToDelete = null; // Store the company card to delete

// Open delete confirmation modal for companies
document.querySelectorAll('.delete-company').forEach((btn) => {
  btn.addEventListener('click', function () {
    const companyCard = this.closest('.company-card');
    if (!companyCard) return;

    companyToDelete = companyCard; // Store the card to delete
    openModal('deleteConfirmationModal'); // Open the confirmation modal
  });
});

// Handle company deletion confirmation
document.getElementById('confirmDelete').addEventListener('click', () => {
  if (companyToDelete) {
    companyToDelete.remove(); // Remove the company card
    companyToDelete = null; // Reset the reference
    closeModal('deleteConfirmationModal'); // Close the modal
  }
});

// Close modal when clicking the "Annuler" button
document.querySelectorAll('#deleteConfirmationModal .close').forEach((btn) => {
  btn.addEventListener('click', () => {
    companyToDelete = null; // Reset the reference
    closeModal('deleteConfirmationModal');
  });
});
