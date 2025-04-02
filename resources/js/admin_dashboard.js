import Chart from 'chart.js/auto';

console.log('admin_dashboard.js chargé avec succès');

document.addEventListener('DOMContentLoaded', () => {
  // Gestion de la navigation entre les sections
  document.querySelectorAll('.nav-links li').forEach((item) => {
    item.addEventListener('click', function () {
      const sectionId = this.getAttribute('data-section');
      const section = document.getElementById(sectionId);

      if (!section) {
        console.error(`Section avec l'ID "${sectionId}" introuvable.`);
        return;
      }

      console.log('Navigation vers :', sectionId);
      document
        .querySelectorAll('.nav-links li')
        .forEach((i) => i.classList.remove('active'));
      this.classList.add('active');

      document
        .querySelectorAll('.section-content')
        .forEach((section) => section.classList.remove('active'));
      section.classList.add('active');
    });
  });

  // Initialisation des graphiques
  const initChart = (canvasId, config) => {
    const canvas = document.getElementById(canvasId);
    if (canvas) {
      new Chart(canvas.getContext('2d'), config);
    } else {
      console.warn(`Canvas pour "${canvasId}" introuvable.`);
    }
  };

  initChart('topCompaniesChart', {
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
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } },
    },
  });

  initChart('domainChart', {
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
      plugins: { legend: { position: 'bottom' } },
    },
  });

  // Gestion des boutons de filtre
  const urlParams = new URLSearchParams(window.location.search);
  const currentStatus = urlParams.get('status');

  document.querySelectorAll('.filter-btn').forEach((btn) => {
    const filter = btn.textContent.trim().toLowerCase();
    let status = '';
    if (filter === 'actives') {
      status = 'active';
    } else if (filter === 'inactives') {
      status = 'inactive';
    }

    if (status === currentStatus || (!currentStatus && filter === 'toutes')) {
      btn.classList.add('active');
    } else {
      btn.classList.remove('active');
    }

    btn.addEventListener('click', function () {
      document
        .querySelectorAll('.filter-btn')
        .forEach((b) => b.classList.remove('active'));
      this.classList.add('active');

      const url = new URL(window.location.href);
      url.searchParams.set('status', status);
      url.searchParams.set('page', 1); // Reset pagination to the first page
      window.location.href = url.toString();
    });
  });

  // Preserve the filter in pagination links
  document.querySelectorAll('.pagination a').forEach((link) => {
    const url = new URL(link.href);
    if (currentStatus) {
      url.searchParams.set('status', currentStatus);
    }
    link.href = url.toString();
  });

  // Add functionality for delete buttons with a custom modal
  const attachDeleteHandlers = () => {
    document.querySelectorAll('.btn-icon.delete').forEach((btn) => {
      btn.addEventListener('click', function () {
        const offerId = this.dataset.id;
        const modal = document.getElementById('deleteModal');
        const confirmButton = modal.querySelector('.confirm-delete');

        // Show the modal
        modal.classList.add('active');

        // Attach confirmation handler
        confirmButton.onclick = () => {
          fetch(`/admin/internships/${offerId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')
                .value,
            },
          })
            .then((response) => {
              if (response.ok) {
                alert('Offre supprimée avec succès.');
                location.reload();
              } else {
                alert("Erreur lors de la suppression de l'offre.");
              }
            })
            .catch((error) =>
              console.error('Erreur lors de la suppression :', error)
            );

          // Hide the modal
          modal.classList.remove('active');
        };

        // Attach cancel handler
        modal.querySelector('.cancel-delete').onclick = () => {
          modal.classList.remove('active');
        };
      });
    });
  };

  // Initialize delete handlers on page load
  attachDeleteHandlers();

  // Gestion des modales
  const toggleModal = (modalId, action) => {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList[action]('active');
    } else {
      console.error(`Modale avec l'ID "${modalId}" introuvable.`);
    }
  };

  document.querySelectorAll('[id^="add"]').forEach((button) => {
    const modalId = button.id.replace('add', '').toLowerCase() + 'Modal';
    button.addEventListener('click', () => toggleModal(modalId, 'add'));
  });

  document.querySelectorAll('.close').forEach((closeButton) => {
    closeButton.addEventListener('click', function () {
      const modal = this.closest('.modal');
      if (modal) toggleModal(modal.id, 'remove');
    });
  });

  document.querySelectorAll('.modal').forEach((modal) => {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) toggleModal(modal.id, 'remove');
    });
  });

  // Gestion des formulaires
  const handleFormSubmit = (formId, callback) => {
    const form = document.getElementById(formId);
    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        callback();
        const modal = form.closest('.modal');
        if (modal) toggleModal(modal.id, 'remove');
      });
    } else {
      console.warn(`Formulaire "${formId}" introuvable.`);
    }
  };

  handleFormSubmit('userForm', () => {
    console.log('Formulaire utilisateur soumis');
    const userType = document.getElementById('userType')?.value;
    if (userType === 'pilot') {
      const selectedStudents = Array.from(
        document.querySelectorAll('#studentList input[type="checkbox"]:checked')
      ).map((checkbox) => checkbox.value);
      console.log('Étudiants associés au pilote :', selectedStudents);
    } else if (userType === 'student') {
      const selectedTutor =
        document.getElementById('studentTutorSelect')?.value;
      console.log("Tuteur associé à l'étudiant :", selectedTutor);
    }
  });

  // Handle form submission for internships
  handleFormSubmit('internshipForm', () => {
    const title = document.getElementById('title')?.value;
    const description = document.getElementById('description')?.value;
    const salary = document.getElementById('salary')?.value;
    const startDate = document.getElementById('start_date')?.value;
    const endDate = document.getElementById('end_date')?.value;
    const companyId = document.getElementById('company_id')?.value;

    if (!title || !companyId) {
      alert('Veuillez remplir tous les champs obligatoires.');
      return;
    }

    const formData = {
      title,
      description,
      salary,
      start_date: startDate,
      end_date: endDate,
      company_id: companyId,
      _token: document.querySelector('input[name="_token"]').value,
    };

    fetch('/admin/internships/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData),
    })
      .then((response) => {
        if (response.ok) {
          alert(
            'Le formulaire a été soumis avec succès et les données ont été enregistrées.'
          );
          location.reload(); // Reload the page to reflect changes
        } else {
          alert('Une erreur est survenue lors de la soumission du formulaire.');
        }
      })
      .catch((error) => {
        console.error('Erreur lors de la soumission du formulaire :', error);
        alert('Une erreur est survenue. Veuillez réessayer.');
      });
  });

  // Suppression avec confirmation
  document.querySelectorAll('[title="Supprimer"]').forEach((btn) => {
    btn.addEventListener('click', function () {
      if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
        const row = this.closest('tr');
        if (row) row.remove();
      }
    });
  });

  // Gestion des notifications et du profil
  const setupClickHandler = (selector, message) => {
    const element = document.querySelector(selector);
    if (element) {
      element.addEventListener('click', () => console.log(message));
    } else {
      console.warn(`Élément "${selector}" introuvable.`);
    }
  };

  setupClickHandler('.notifications', 'Notifications clicked');
  setupClickHandler('.profile', 'Profile clicked');

  // Barre de recherche
  const searchBarInput = document.querySelector('.search-bar input');
  if (searchBarInput) {
    searchBarInput.addEventListener('input', (e) =>
      console.log('Recherche :', e.target.value)
    );
  } else {
    console.warn('Barre de recherche introuvable.');
  }

  // Gestion des permissions et des paramètres de sécurité
  const setupCheckboxHandler = (selector, message) => {
    document.querySelectorAll(selector).forEach((checkbox) => {
      checkbox.addEventListener('change', function () {
        console.log(message, this.checked);
      });
    });
  };

  setupCheckboxHandler(
    '.permission input[type="checkbox"]',
    'Permission changed:'
  );
  setupCheckboxHandler(
    '.security-settings .switch input',
    'Security setting changed:'
  );

  // Gestion des actions GDPR
  document.querySelectorAll('.gdpr-settings .btn-secondary').forEach((btn) => {
    btn.addEventListener('click', function () {
      console.log('GDPR action:', this.textContent);
    });
  });

  // Affichage conditionnel des sections utilisateur
  const userTypeSelect = document.getElementById('userType');
  if (userTypeSelect) {
    const sections = {
      pilot: document.getElementById('pilotSection'),
      student: document.getElementById('studentTutor'),
    };

    userTypeSelect.addEventListener('change', function () {
      Object.keys(sections).forEach((key) => {
        if (sections[key])
          sections[key].style.display = this.value === key ? 'block' : 'none';
      });
    });
  }

  // Initialisation des listes dynamiques
  const initDropdown = (inputId, dropdownId, data, onSelect) => {
    const input = document.getElementById(inputId);
    const dropdown = document.getElementById(dropdownId);

    if (input && dropdown) {
      const renderDropdown = (filter = '') => {
        dropdown.innerHTML = '';
        const filteredData = data.filter((item) =>
          item.name.toLowerCase().includes(filter.toLowerCase())
        );
        filteredData.forEach((item) => {
          const listItem = document.createElement('li');
          listItem.textContent = item.name;
          listItem.dataset.id = item.id;
          listItem.classList.add('dropdown-item');
          listItem.addEventListener('click', () => {
            onSelect(item);
            dropdown.style.display = 'none'; // Masquer après sélection
          });
          dropdown.appendChild(listItem);
        });
        dropdown.style.display = filteredData.length ? 'block' : 'none';
      };

      input.addEventListener('input', () => renderDropdown(input.value));
      input.addEventListener('focus', () => renderDropdown(''));
      document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
          dropdown.style.display = 'none';
        }
      });
    }
  };

  document.addEventListener('DOMContentLoaded', () => {
    const companySearch = document.getElementById('companySearch');
    const companyDropdown = document.getElementById('companyDropdown');
    const selectedCompany = document.getElementById('selectedCompany');
    const companyIdInput = document.getElementById('company_id');

    companySearch.addEventListener('input', function () {
      const filter = this.value.toLowerCase();
      const items = companyDropdown.querySelectorAll('.dropdown-item');

      let hasVisibleItems = false;
      items.forEach((item) => {
        if (item.textContent.toLowerCase().includes(filter)) {
          item.style.display = 'block';
          hasVisibleItems = true;
        } else {
          item.style.display = 'none';
        }
      });

      companyDropdown.style.display = hasVisibleItems ? 'block' : 'none';
    });

    companyDropdown.addEventListener('click', function (e) {
      if (e.target.classList.contains('dropdown-item')) {
        const companyName = e.target.textContent;
        const companyId = e.target.dataset.id;

        selectedCompany.textContent = `Entreprise sélectionnée : ${companyName}`;
        companyIdInput.value = companyId;
        companyDropdown.style.display = 'none';
        companySearch.value = '';
      }
    });

    document.addEventListener('click', function (e) {
      if (
        !companySearch.contains(e.target) &&
        !companyDropdown.contains(e.target)
      ) {
        companyDropdown.style.display = 'none';
      }
    });
  });

  // Suggestions dynamiques pour les étudiants, entreprises et pilotes
  const students = [];
  const companies = [];
  const pilots = [];
  const skills = [];

  fetch('/api/students')
    .then((response) => response.json())
    .then((data) => {
      initDropdown('studentSearch', 'studentDropdown', data, (student) => {
        const selectedTable = document.getElementById('selectedStudentsTable');
        if (selectedTable) {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${student.name}</td>
            <td class="action-cell">
              <button class="btn-icon delete" data-id="${student.id}">
                <i class="fas fa-trash"></i>
              </button>
            </td>`;
          selectedTable.querySelector('tbody').appendChild(row);

          row.querySelector('.delete').addEventListener('click', () => {
            row.remove();
          });
        }
      });
    })
    .catch((error) =>
      console.error('Erreur lors de la récupération des étudiants :', error)
    );

  fetch('/api/companies')
    .then((response) => response.json())
    .then((data) => {
      initDropdown('companySearch', 'companyDropdown', data, (company) => {
        document.getElementById(
          'selectedCompany'
        ).textContent = `Entreprise sélectionnée : ${company.name}`;
        document.getElementById('company_id').value = company.id;
      });
    })
    .catch((error) =>
      console.error('Erreur lors de la récupération des entreprises :', error)
    );

  fetch('/api/pilots')
    .then((response) => response.json())
    .then((data) => {
      initDropdown('pilotSearch', 'pilotDropdown', data, (pilot) => {
        document.getElementById(
          'selectedPilot'
        ).textContent = `Pilote sélectionné : ${pilot.name}`;
      });
    })
    .catch((error) =>
      console.error('Erreur lors de la récupération des pilotes :', error)
    );

  fetch('/api/skills')
    .then((response) => response.json())
    .then((data) => {
      initDropdown('skillsSearch', 'skillsDropdown', data, (skill) => {
        const selectedTable = document.getElementById('selectedSkillsTable');
        if (selectedTable) {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${skill.name}</td>
            <td class="action-cell">
              <button class="btn-icon delete" data-id="${skill.id}">
                <i class="fas fa-trash"></i>
              </button>
            </td>`;
          selectedTable.querySelector('tbody').appendChild(row);

          row.querySelector('.delete').addEventListener('click', () => {
            row.remove();
          });
        }
      });
    })
    .catch((error) =>
      console.error('Erreur lors de la récupération des compétences :', error)
    );
});

document.addEventListener('DOMContentLoaded', () => {
  // Gestion du formulaire d'ajout de pilote
  const pilotForm = document.getElementById('userForm');
  if (pilotForm) {
    pilotForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(pilotForm);
      const data = Object.fromEntries(formData.entries());

      try {
        const response = await fetch(pilotForm.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')
              .value,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });

        if (response.ok) {
          alert('Pilote ajouté avec succès.');
          location.reload(); // Recharger la page pour afficher les changements
        } else {
          const errorData = await response.json();
          alert(
            'Erreur : ' + (errorData.message || 'Une erreur est survenue.')
          );
        }
      } catch (error) {
        console.error('Erreur lors de la soumission du formulaire :', error);
        alert('Une erreur est survenue. Veuillez réessayer.');
      }
    });
  }
});
