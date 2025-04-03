// Importation des dépendances
import Chart from 'chart.js/auto';

console.log('admin_dashboard.js chargé avec succès');

document.addEventListener('DOMContentLoaded', () => {
  // Gestion de la navigation entre les sections
  const setupNavigation = () => {
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
  };

  // Initialisation des graphiques
  const setupCharts = () => {
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
  };

  // Gestion des boutons de filtre
  const setupFilters = () => {
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
  };

  // Gestion des modales
  const setupModals = () => {
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
  };

  // Gestion des formulaires
  const setupForms = () => {
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
          document.querySelectorAll(
            '#studentList input[type="checkbox"]:checked'
          )
        ).map((checkbox) => checkbox.value);
        console.log('Étudiants associés au pilote :', selectedStudents);
      } else if (userType === 'student') {
        const selectedTutor =
          document.getElementById('studentTutorSelect')?.value;
        console.log("Tuteur associé à l'étudiant :", selectedTutor);
      }
    });

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
            alert(
              'Une erreur est survenue lors de la soumission du formulaire.'
            );
          }
        })
        .catch((error) => {
          console.error('Erreur lors de la soumission du formulaire :', error);
          alert('Une erreur est survenue. Veuillez réessayer.');
        });
    });
  };

  // Gestion des détails des offres
  const setupOfferDetails = () => {
    const offerRows = document.querySelectorAll('.offer-row');
    const modal = document.getElementById('offerDetailsModal');
    const closeModal = document.getElementById('closeOfferDetailsModal');

    const modalTitle = document.getElementById('modalOfferTitle');
    const modalDescription = document.getElementById('modalOfferDescription');
    const modalSalary = document.getElementById('modalOfferSalary');
    const modalCompany = document.getElementById('modalOfferCompany');
    const modalStartDate = document.getElementById('modalOfferStartDate');
    const modalEndDate = document.getElementById('modalOfferEndDate');

    offerRows.forEach((row) => {
      row.addEventListener('click', () => {
        const offerId = row.getAttribute('data-offer-id');

        // Use the controller route to fetch offer details
        fetch(`/offers/${offerId}`)
          .then((response) => {
            if (!response.ok) {
              throw new Error('Failed to fetch offer details');
            }
            return response.json();
          })
          .then((data) => {
            modalTitle.textContent = data.title;
            modalDescription.textContent = data.description || 'Non renseignée';
            modalSalary.textContent = data.salary
              ? `${data.salary} €`
              : 'Non renseigné';
            modalCompany.textContent = data.company_name || 'Non renseignée';
            modalStartDate.textContent = data.start_date || 'Non renseignée';
            modalEndDate.textContent = data.end_date || 'Non renseignée';

            modal.style.display = 'block';
          })
          .catch((error) => {
            console.error('Error fetching offer details:', error);
            alert(
              "Une erreur est survenue lors de la récupération des détails de l'offre."
            );
          });
      });
    });

    closeModal.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  };

  // Initialisation des fonctionnalités
  setupNavigation();
  setupCharts();
  setupFilters();
  setupModals();
  setupForms();
  setupOfferDetails();
});
