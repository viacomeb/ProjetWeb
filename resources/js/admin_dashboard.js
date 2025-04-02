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
  document.querySelectorAll('.filter-btn').forEach((btn) => {
    btn.addEventListener('click', function () {
      const parent = this.parentElement;
      if (!parent) return;

      parent
        .querySelectorAll('.filter-btn')
        .forEach((b) => b.classList.remove('active'));
      this.classList.add('active');
    });
  });

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

  // Suggestions dynamiques pour les étudiants, entreprises et pilotes
  const students = [
    { id: 1, name: 'Alice Dupont' },
    { id: 2, name: 'Bob Martin' },
    { id: 3, name: 'Charlie Durand' },
  ];

  const companies = [
    { id: 1, name: 'TechCorp' },
    { id: 2, name: 'DataInsight' },
    { id: 3, name: 'WebSolutions' },
  ];

  const pilots = [
    { id: 1, name: 'Jean Martin' },
    { id: 2, name: 'Claire Dupont' },
    { id: 3, name: 'Paul Durand' },
  ];

  initDropdown('studentSearch', 'studentDropdown', students, (student) => {
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

  initDropdown('companySearch', 'companyDropdown', companies, (company) => {
    document.getElementById(
      'selectedCompany'
    ).textContent = `Entreprise sélectionnée : ${company.name}`;
    document.getElementById('company_id').value = company.id;
  });

  initDropdown('pilotSearch', 'pilotDropdown', pilots, (pilot) => {
    document.getElementById(
      'selectedPilot'
    ).textContent = `Pilote sélectionné : ${pilot.name}`;
  });

  const skills = [
    { id: 1, name: 'JavaScript' },
    { id: 2, name: 'Python' },
    { id: 3, name: 'HTML' },
    { id: 4, name: 'CSS' },
    { id: 5, name: 'React' },
  ];

  initDropdown('skillsSearch', 'skillsDropdown', skills, (skill) => {
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
});
