document.addEventListener('DOMContentLoaded', function () {
  console.log('Script chargé : student_dashboard.js');

  // Gestion du menu burger
  const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
  const sidebar = document.querySelector('.sidebar');
  const body = document.body;

  // Fonction pour réinitialiser le menu burger
  function resetMenuBurger() {
    if (mobileMenuBtn) {
      mobileMenuBtn.classList.remove('active');
    }
    if (sidebar) {
      sidebar.classList.remove('active');
    }
    if (body) {
      body.style.overflow = '';
    }
  }

  if (mobileMenuBtn && sidebar) {
    mobileMenuBtn.addEventListener('click', function () {
      this.classList.toggle('active');
      sidebar.classList.toggle('active');
      body.style.overflow = sidebar.classList.contains('active')
        ? 'hidden'
        : '';
    });

    // Fermer le menu en cliquant en dehors
    document.addEventListener('click', function (event) {
      if (
        sidebar.classList.contains('active') &&
        !sidebar.contains(event.target) &&
        !mobileMenuBtn.contains(event.target)
      ) {
        resetMenuBurger();
      }
    });

    // Fermer le menu en cliquant sur un lien
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach((link) => {
      link.addEventListener('click', function () {
        resetMenuBurger();
      });
    });

    // Réinitialiser le menu lors du changement de page
    window.addEventListener('beforeunload', resetMenuBurger);
  }

  const starRating = document.querySelector('.star-rating');
  const ratingValue = document.getElementById('ratingValue'); // Déclarez `ratingValue` ici

  // Fonction pour mettre à jour l'affichage des étoiles
  function updateStarDisplay(rating) {
    const stars = starRating.querySelectorAll('i'); // Sélectionnez toutes les étoiles
    stars.forEach((star) => {
      const starValue = parseInt(star.getAttribute('data-value'), 10); // Récupérez la valeur de chaque étoile
      if (starValue <= rating) {
        star.classList.remove('far'); // Supprime la classe "far" (contour)
        star.classList.add('fas', 'yellow'); // Ajoute la classe "fas" (plein) et "yellow" (jaune)
      } else {
        star.classList.remove('fas', 'yellow'); // Supprime les classes "fas" et "yellow"
        star.classList.add('far'); // Ajoute la classe "far" (contour)
      }
    });
  }

  if (starRating && ratingValue) {
    starRating.addEventListener('click', (event) => {
      const star = event.target.closest('i');
      if (star) {
        const rating = parseInt(star.dataset.value, 10);
        console.log(`Étoile cliquée : ${rating}`); // Debug : Affiche l'étoile cliquée
        ratingValue.textContent = `Note : ${rating}`;
        updateStarDisplay(rating);
        console.log(`Entreprise notée avec ${rating} étoiles.`);
      }
    });
  }

  const offerModal = document.getElementById('offerModal');
  const companyModal = document.getElementById('companyModal'); // Modal pour les entreprises
  const companyModalTitle = document.getElementById('companyModalTitle');
  const companyDescription = document.getElementById('companyDescription');
  const companyPhone = document.getElementById('companyPhone');
  const companyEmail = document.getElementById('companyEmail');
  const companyAddress = document.getElementById('companyAddress');
  const offerModalTitle = document.getElementById('offerModalTitle');
  const offerModalCompany = document.getElementById('offerModalCompany');
  const offerModalLocation = document.getElementById('offerModalLocation');
  const offerModalSalary = document.getElementById('offerModalSalary');
  const offerModalDetails = document.getElementById('offerModalDetails');

  // Vérifiez que les modals existent
  if (
    !offerModal ||
    !companyModal ||
    !companyModalTitle ||
    !companyDescription ||
    !companyPhone ||
    !companyEmail ||
    !companyAddress ||
    !offerModalTitle ||
    !offerModalCompany ||
    !offerModalLocation ||
    !offerModalSalary ||
    !offerModalDetails
  ) {
    console.error('Un ou plusieurs éléments des modals sont introuvables.');
    return;
  }

  // Gestion des clics sur les boxes et le nom de l'entreprise
  document.addEventListener('click', function (event) {
    const clickedStar = event.target.closest('i');
    const closeButton = event.target.closest('.close'); // Vérifie si le clic est sur un bouton "Fermer"
    const wishlistButton = event.target.closest(
      '.offer-actions .btn-secondary'
    ); // Vérifie si le clic est sur un bouton "Ajouter à la wishlist"
    const modificationButton = event.target.closest(
      '.profile-info .btn-secondary'
    ); // Vérifie si le clic est sur le bouton "Modifier les informations"

    const abortButton = event.target.closest('.form-actions .btn-secondary'); // Vérifie si le clic est sur le bouton "Annuler" du formulaire de profil

    const submitProfileButton = event.target.closest(
      '.form-actions .btn-primary'
    ); // Vérifie si le clic est sur le bouton "Soumettre" du formulaire de profil

    const applyButton = event.target.closest('.offer-actions .btn-primary');

    if (applyButton && !applyButton.closest('.modal')) {
      const offerCard = applyButton.closest('.offer-card');
      if (!offerCard) {
        console.error("Impossible de trouver l'offre associée au bouton.");
        return;
      }

      const offerTitle =
        offerCard.querySelector('.offer-info h3')?.textContent ||
        'Offre inconnue';

      // Changez la couleur du bouton en gris et désactivez-le
      applyButton.style.backgroundColor = 'gray';
      applyButton.style.cursor = 'not-allowed';
      applyButton.disabled = true;

      // Affichez une notification
      showNotification(`Vous avez postulé à "${offerTitle}".`);
      return;
    }
    if (clickedStar) {
      const rating = parseInt(clickedStar.getAttribute('data-value'), 10); // Récupérez la valeur de l'étoile cliquée
      console.log(`Étoile cliquée : ${rating}`); // Debug : Affiche la valeur cliquée

      // Mettez à jour l'affichage des étoiles
      updateStarDisplay(rating);

      // Mettez à jour la note affichée
      ratingValue.textContent = `Note : ${rating}/5`;
    } else if (closeButton) {
      const modal = closeButton.closest('.modal');
      if (modal) {
        modal.classList.remove('active');
        console.log('Modal fermé.');
      }
      return; // Ignore les autres actions si le clic est sur un bouton "Fermer"
    }

    if (wishlistButton) {
      const offerCard = wishlistButton.closest('.offer-card');
      if (!offerCard) {
        console.error("Impossible de trouver l'offre associée au bouton.");
        return;
      }

      const offer = {
        title:
          offerCard.querySelector('.offer-info h3')?.textContent ||
          'Titre inconnu',
        company:
          offerCard.querySelector('.offer-info p')?.textContent ||
          'Entreprise inconnue',
        location:
          offerCard.querySelector('.offer-details p:nth-child(1)')
            ?.textContent || 'Localisation inconnue',
        salary:
          offerCard.querySelector('.offer-details p:nth-child(2)')
            ?.textContent || 'Rémunération inconnue',
      };

      toggleWishlist(offer, wishlistButton);
      return; // Empêche l'exécution des autres actions
    }

    if (modificationButton) {
      const profileForm = document.getElementById('profileForm');
      if (!profileForm) {
        console.error('Impossible de trouver le formulaire de profil.');
        return;
      }
      document.getElementById('profileInfo').classList.add('hidden'); // Masque le bouton de modification
      profileForm.classList.remove('hidden'); // Affiche le formulaire de profil
      console.log('Formulaire de profil affiché.');

      // Pré-remplir le formulaire avec les informations actuelles
      const NameField = document.getElementById('Name');
      const firstNameField = document.getElementById('firstName');
      const emailField = document.getElementById('email');
      const phoneField = document.getElementById('phone');

      if (NameField && emailField && phoneField && firstNameField) {
        NameField.value =
          document.getElementById('profileName')?.textContent.trim() || '';
        firstNameField.value =
          document.getElementById('profileFirstName')?.textContent.trim() || '';
        emailField.value =
          document.getElementById('profileEmail')?.textContent.trim() || '';
        phoneField.value =
          document.getElementById('profilePhone')?.textContent.trim() || '';
      }

      return; // Empêche l'exécution des autres actions
    }

    if (abortButton) {
      // Réafficher les informations de base
      profileInfo.classList.remove('hidden');

      // Masquer le formulaire
      profileForm.classList.add('hidden');
      return;
    }

    if (submitProfileButton) {
      console.log('Soumettre le formulaire de profil.');
      // Mettre à jour les informations affichées
      const Name = document.getElementById('Name')?.value || '';
      const firstName = document.getElementById('firstName')?.value || '';
      const email = document.getElementById('email')?.value || '';
      const phone = document.getElementById('phone')?.value || '';

      document.getElementById('profileName').textContent = Name;
      document.getElementById('profileFirstName').textContent = firstName;
      document.getElementById('profileEmail').textContent = email;
      document.getElementById('profilePhone').textContent = phone;

      // Réinitialiser l'affichage
      profileInfo.classList.remove('hidden');
      profileForm.classList.add('hidden');
      return;
    }

    if (closeButton) {
      const modal = closeButton.closest('.modal');
      if (modal) {
        modal.classList.remove('active');
        console.log('Modal fermé.');
      }
      return; // Ignore les autres actions si le clic est sur un bouton "Fermer"
    }

    const companyNameElement = event.target.closest('.offer-info p'); // Check if the company name was clicked
    if (companyNameElement) {
      const companyName = companyNameElement.textContent.trim();
      console.log(`Nom de l'entreprise cliqué : ${companyName}`);

      // Generate companyId by replacing spaces with underscores and converting to lowercase
      const companyId = companyName.toLowerCase().replace(/\s+/g, '_');
      console.log(`Generated companyId: ${companyId}`);

      // Fetch company data
      fetch(`/companies/${companyId}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.text(); // Read the response as text
        })
        .then((responseText) => {
          try {
            const data = JSON.parse(responseText); // Attempt to parse JSON
            console.log('Company data fetched successfully:', data);

            // Populate modal with company data
            companyModalTitle.textContent =
              data.company_name || 'Nom non disponible';
            companyDescription.textContent =
              data.description || 'Description non renseignée';
            companyPhone.textContent = data.phone || 'Téléphone non renseigné';
            companyEmail.textContent = data.email || 'Email non renseigné';
            companyAddress.textContent = `${data.street || ''} ${
              data.street_number || ''
            }, ${data.city_name || ''}`;

            // Show the modal
            companyModal.classList.add('active');
          } catch (error) {
            console.error('Error parsing JSON response:', error);
            console.error('Response text:', responseText);
            alert(
              "Une erreur est survenue lors de la récupération des données de l'entreprise. La réponse n'est pas au format JSON attendu."
            );
          }
        })
        .catch((error) => {
          console.error('Error fetching company data:', error);
          alert(
            `Une erreur est survenue lors de la récupération des données de l'entreprise. Détails : ${error.message}`
          );
        });

      return; // Prevent opening the offer modal
    }

    const box = event.target.closest('.offer-card'); // Vérifie si le clic est sur une box
    if (box) {
      const boxId = box.dataset.id; // Use data-id instead of id
      if (!boxId) {
        console.error("L'attribut data-id de l'offre est introuvable.");
        return;
      }

      const [title, company] = boxId.split('--');
      if (!title || !company) {
        console.error("Impossible de récupérer les informations de l'offre.");
        return;
      }

      const offer = {
        title: title.replace(/_/g, ' '),
        company: company.replace(/_/g, ' '),
        location:
          box.querySelector('.offer-location')?.textContent.trim() ||
          'Non spécifiée',
        salary:
          box.querySelector('.offer-salary')?.textContent.trim() ||
          'Non spécifiée',
      };

      console.log("Informations de l'offre récupérées :", offer);

      // Remplir les informations du modal
      offerModalTitle.textContent = offer.title;
      offerModalCompany.textContent = offer.company;
      offerModalLocation.textContent = offer.location;
      offerModalSalary.textContent = offer.salary;
      offerModalDetails.innerHTML = `
          <p>${offer.location}</p>
          <p>${offer.salary}</p>
        `;

      // Afficher le modal
      offerModal.classList.add('active');
      console.log('Modal offre ouvert.');
    }

    if (event.target.closest('.offer-actions .btn-secondary')) {
      const offerCard = event.target.closest('.offer-card');
      if (!offerCard) {
        console.error("Impossible de trouver l'offre associée au bouton.");
        return;
      }

      const offer = {
        title:
          offerCard.querySelector('.offer-info h3')?.textContent ||
          'Titre inconnu',
        company:
          offerCard.querySelector('.offer-info p')?.textContent ||
          'Entreprise inconnue',
        location:
          offerCard.querySelector('.offer-details p:nth-child(1)')
            ?.textContent || 'Localisation inconnue',
        salary:
          offerCard.querySelector('.offer-details p:nth-child(2)')
            ?.textContent || 'Rémunération inconnue',
      };

      toggleWishlist(offer, event.target.closest('offer-grid, .btn-secondary'));
    }
  });

  // Fermer les modals
  document.querySelectorAll('.modal .close').forEach((closeButton) => {
    closeButton.addEventListener('click', function () {
      const modal = this.closest('.modal');
      if (modal) modal.classList.remove('active');
      console.log('Modal fermé.');
    });
  });

  // Fermer les modals en cliquant à l'extérieur
  document.querySelectorAll('.modal').forEach((modal) => {
    modal.addEventListener('click', function (event) {
      if (event.target === modal) {
        modal.classList.remove('active');
        console.log("Modal fermé en cliquant à l'extérieur.");
      }
    });
  });

  // Navigation
  document.querySelectorAll('.nav-links li').forEach((item) => {
    item.addEventListener('click', function () {
      // Supprimez la classe active de tous les éléments
      document
        .querySelectorAll('.nav-links li')
        .forEach((i) => i.classList.remove('active'));
      // Ajoutez la classe active à l'élément cliqué
      this.classList.add('active');

      // Masquez toutes les sections
      document.querySelectorAll('.section-content').forEach((section) => {
        section.classList.remove('active');
      });

      // Affichez la section correspondante
      const sectionId = this.getAttribute('data-section');
      const targetSection = document.getElementById(sectionId);

      if (targetSection) {
        console.log(`Navigating to section: ${sectionId}`); // Debug: Log the section ID
        targetSection.classList.add('active');
      } else {
        console.error(`Section with ID "${sectionId}" not found.`);
      }
    });
  });

  // Apply/Save buttons
  document.querySelectorAll('.modal-actions .btn-primary').forEach((btn) => {
    btn.addEventListener('click', function () {
      // TODO: Implement respective actions
      console.log('Action:', this.textContent);
    });
  });

  // Notification System
  function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          background-color: var(--primary-color);
          color: white;
          padding: 15px 20px;
          border-radius: 8px;
          box-shadow: 0 2px 5px rgba(0,0,0,0.2);
          z-index: 1000;
          animation: slideIn 0.3s ease-out;
        `;
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
      notification.style.animation = 'slideOut 0.3s ease-out';
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  }

  // Add animation keyframes
  const style = document.createElement('style');
  style.textContent = `
        @keyframes slideIn {
          from { transform: translateX(100%); opacity: 0; }
          to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
          from { transform: translateX(0); opacity: 1; }
          to { transform: translateX(100%); opacity: 0; }
        }
      `;
  document.head.appendChild(style);

  // Forum Post Interactions
  document.querySelectorAll('.post-actions button').forEach((button) => {
    button.addEventListener('click', function () {
      const post = this.closest('.forum-post');
      const postAuthor = post.querySelector('h4').textContent;

      // Create reply form
      const replyForm = document.createElement('div');
      replyForm.className = 'reply-form';
      replyForm.innerHTML = `
            <textarea placeholder="Répondre à ${postAuthor}..." class="reply-input"></textarea>
            <div class="reply-actions">
              <button class="send-reply">Envoyer</button>
              <button class="cancel-reply">Annuler</button>
            </div>
          `;

      // Add styles
      const textarea = replyForm.querySelector('textarea');
      textarea.style.cssText = `
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid var(--gray-medium);
            border-radius: 8px;
            resize: vertical;
          `;

      const actions = replyForm.querySelector('.reply-actions');
      actions.style.cssText = `
            display: flex;
            gap: 10px;
            justify-content: flex-end;
          `;

      // Only add form if it doesn't exist yet
      if (!post.querySelector('.reply-form')) {
        post.appendChild(replyForm);
      }
    });
  });

  // Handle likes
  document.querySelectorAll('.post-actions span').forEach((likeCounter) => {
    likeCounter.style.cursor = 'pointer';
    let liked = false;

    likeCounter.addEventListener('click', function () {
      const likesText = this.textContent;
      const currentLikes = parseInt(likesText.match(/\d+/)[0]);

      if (!liked) {
        this.textContent = likesText.replace(currentLikes, currentLikes + 1);
        this.style.color = '#ef4444';
        liked = true;
      } else {
        this.textContent = likesText.replace(currentLikes, currentLikes - 1);
        this.style.color = 'var(--secondary-color)';
        liked = false;
      }
    });
  });

  // Contact Mentor Functionality
  document.querySelectorAll('.contact-mentor').forEach((button) => {
    button.addEventListener('click', function () {
      const mentorName =
        this.closest('.mentor-card').querySelector('h4').textContent;

      // Show chat interface (simplified example)
      showNotification(`Chat ouvert avec ${mentorName}`);

      // Change button state
      this.textContent = 'En discussion';
      this.style.backgroundColor = '#10b981';
      this.disabled = true;
    });
  });

  // Progress Animation
  function animateProgress() {
    document.querySelectorAll('.progress-bar .progress').forEach((bar) => {
      const width = bar.style.width;
      bar.style.width = '0';
      setTimeout(() => {
        bar.style.width = width;
      }, 100);
    });
  }

  // Run progress animation on page load
  animateProgress();

  // Filter Functionality
  document.querySelectorAll('.filter-btn').forEach((btn) => {
    btn.addEventListener('click', function () {
      // Remove active class from all buttons in the same filter group
      this.parentElement.querySelectorAll('.filter-btn').forEach((b) => {
        b.classList.remove('active');
      });
      // Add active class to clicked button
      this.classList.add('active');

      // Filter logic would go here
      // For now, just show animation
      animateProgress();
    });
  });

  // Remove hardcoded offers and rely on backend-rendered data
  function renderOffers() {
    console.log('Offers are now rendered dynamically from the backend.');
  }

  // Remove hardcoded pagination logic if not needed
  function renderPagination() {
    console.log('Pagination is handled dynamically if required.');
  }

  // Initial rendering (no longer needed for hardcoded data)
  renderOffers();
  renderPagination();

  const posts = [
    {
      author: 'Lucas Dubois',
      time: 'Il y a 2h',
      title: 'Conseils pour un entretien tech ?',
      content:
        'Je passe un entretien chez TechCorp la semaine prochaine, des conseils ?',
      comments: 12,
      likes: 5,
    },
    {
      author: 'Emma Bernard',
      time: 'Il y a 4h',
      title: "Retour d'expérience : Stage Data Science",
      content:
        'Je viens de terminer mon stage chez DataInsight, je partage mon expérience !',
      comments: 8,
      likes: 15,
    },
    {
      author: 'Thomas Laurent',
      time: 'Il y a 1j',
      title: 'Comment améliorer son CV ?',
      content:
        "J'aimerais avoir des conseils pour rendre mon CV plus attractif pour les recruteurs.",
      comments: 20,
      likes: 10,
    },
    // Ajoutez plus de posts ici...
  ];

  const postsPerPage = 10;
  let currentCommunityPage = 1;

  function renderCommunityPosts(page) {
    const forumPosts = document.getElementById('forumPosts');
    forumPosts.innerHTML = '';

    const start = (page - 1) * postsPerPage;
    const end = start + postsPerPage;
    const paginatedPosts = posts.slice(start, end);

    paginatedPosts.forEach((post) => {
      const postElement = document.createElement('div');
      postElement.className = 'forum-post';
      postElement.innerHTML = `
          <div class="post-author">
            <img src="https://ui-avatars.com/api/?name=${post.author}" alt="Author" />
            <div class="author-info">
              <h4>${post.author}</h4>
              <span>${post.time}</span>
            </div>
          </div>
          <div class="post-content">
            <h3>${post.title}</h3>
            <p>${post.content}</p>
            <div class="post-stats">
              <span><i class="fas fa-comment"></i> ${post.comments} réponses</span>
              <span><i class="fas fa-heart"></i> ${post.likes} likes</span>
            </div>
          </div>
        `;
      forumPosts.appendChild(postElement);
    });
  }

  function renderCommunityPagination() {
    const pagination = document.getElementById('communityPagination');
    pagination.innerHTML = '';

    const totalPages = Math.ceil(posts.length / postsPerPage);

    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement('button');
      button.textContent = i;
      button.className = i === currentCommunityPage ? 'active' : '';
      button.addEventListener('click', () => {
        currentCommunityPage = i;
        renderCommunityPosts(currentCommunityPage);
        renderCommunityPagination();
      });
      pagination.appendChild(button);
    }
  }

  // Initial rendering for community posts
  renderCommunityPosts(currentCommunityPage);
  renderCommunityPagination();

  const wishlist = [];
  const wishlistPerPage = 10;
  let currentWishlistPage = 1;

  // Fonction pour ajouter ou retirer une offre de la wishlist
  function toggleWishlist(offer, button) {
    const index = wishlist.findIndex((item) => item.title === offer.title);

    if (index === -1) {
      // Ajouter à la wishlist
      wishlist.push(offer);
      showNotification(`"${offer.title}" a été ajouté à votre wishlist.`);
      button.style.backgroundColor = 'gold';
      button.innerHTML = '<i class="fas fa-bookmark"></i> Retirer des favoris';
    } else {
      // Retirer de la wishlist
      wishlist.splice(index, 1);
      showNotification(`"${offer.title}" a été retiré de votre wishlist.`);
      button.style.backgroundColor = '';
      button.innerHTML = '<i class="fas fa-bookmark"></i> Ajouter aux favoris';
    }

    // Toujours mettre à jour l'affichage de la wishlist
    renderWishlist(currentWishlistPage);
    renderWishlistPagination();
  }

  // Fonction pour afficher les offres de la wishlist
  function renderWishlist(page) {
    const wishlistGrid = document.getElementById('wishlistGrid');
    wishlistGrid.innerHTML = '';

    if (wishlist.length === 0) {
      wishlistGrid.innerHTML = '<p>Aucune offre dans votre wishlist.</p>';
      return;
    }

    const start = (page - 1) * wishlistPerPage;
    const end = start + wishlistPerPage;
    const paginatedWishlist = wishlist.slice(start, end);

    paginatedWishlist.forEach((offer) => {
      const offerCard = document.createElement('div');
      offerCard.className = 'offer-card';
      offerCard.innerHTML = `
          <div class="box_offer" data-id="${offer.title}_${offer.company}">
            <div class="offer-header">
          <img src="https://ui-avatars.com/api/?name=${offer.company}" alt="Company Logo" class="company-logo" />
          <div class="offer-info">
            <h3>${offer.title}</h3>
            <p>${offer.company}</p>
          </div>
            </div>
            <div class="offer-details">
          <p><i class="fas fa-map-marker-alt"></i> ${offer.location}</p>
          <p><i class="fas fa-euro-sign"></i> ${offer.salary}</p>
            </div>
            <div class="offer-actions">
          <button class="btn-primary"><i class="fas fa-paper-plane"></i> Postuler</button>
          <button class="btn-secondary" style="background-color: gold;"><i class="fas fa-bookmark"></i> Retirer des favoris</button>
            </div>
          </div>
        `;

      // Ajouter un événement pour retirer l'offre de la wishlist
      const wishlistButton = offerCard.querySelector(
        'offer-grid, .btn-secondary'
      );
      wishlistButton.addEventListener('click', () =>
        toggleWishlist(offer, wishlistButton)
      );

      wishlistGrid.appendChild(offerCard);
    });
  }

  // Fonction pour afficher la pagination de la wishlist
  function renderWishlistPagination() {
    const pagination = document.getElementById('wishlistPagination');
    pagination.innerHTML = '';

    const totalPages = Math.ceil(wishlist.length / wishlistPerPage);

    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement('button');
      button.textContent = i;
      button.className = i === currentWishlistPage ? 'active' : '';
      button.addEventListener('click', () => {
        currentWishlistPage = i;
        renderWishlist(currentWishlistPage);
        renderWishlistPagination();
      });
      pagination.appendChild(button);
    }
  }

  // Initial rendering for wishlist
  renderWishlist(currentWishlistPage);
  renderWishlistPagination();
  const profileForm = document.getElementById('profileForm');
  // Gestion de la soumission du formulaire de profil
  if (profileForm) {
    profileForm.addEventListener('submit', (event) => {
      event.preventDefault(); // Empêche le rechargement de la page
      console.log('Formulaire de profil soumis.');

      // Mettre à jour les informations affichées
      const Name = document.getElementById('Name')?.value || '';
      const firstName = document.getElementById('firstName')?.value || '';
      const email = document.getElementById('email')?.value || '';
      const phone = document.getElementById('phone')?.value || '';

      document.getElementById('profileName').textContent = Name;
      document.getElementById('profileFirstName').textContent = firstName;
      document.getElementById('profileEmail').textContent = email;
      document.getElementById('profilePhone').textContent = phone;

      // Réinitialiser l'affichage
      document.getElementById('profileInfo').classList.remove('hidden');
      profileForm.classList.add('hidden');
      document.getElementById('editProfile').style.display = 'block';

      console.log('Profil mis à jour avec succès.');
    });
  } else {
    console.warn('Le formulaire de profil "profileForm" est introuvable.');
  }

  // Fonction de validation des fichiers
  const validateFile = (fileInput) => {
    const file = fileInput.files[0];
    const errorMessage = document.createElement('p');
    errorMessage.className = 'file-error';
    errorMessage.style.color = 'red';

    // Supprimez les anciens messages d'erreur
    const existingError = fileInput.parentElement.querySelector('.file-error');
    if (existingError) existingError.remove();

    if (file) {
      const isPDF = file.type === 'application/pdf';
      const isUnder2MB = file.size <= 2 * 1024 * 1024; // 2 Mo

      if (!isPDF) {
        errorMessage.textContent = 'Seuls les fichiers PDF sont autorisés.';
        fileInput.parentElement.appendChild(errorMessage);
        fileInput.value = ''; // Réinitialise le champ
        console.log("Validation échouée : le fichier n'est pas un PDF.");
        return false;
      }

      if (!isUnder2MB) {
        errorMessage.textContent =
          'La taille du fichier ne doit pas dépasser 2 Mo.';
        fileInput.parentElement.appendChild(errorMessage);
        fileInput.value = ''; // Réinitialise le champ
        console.log('Validation échouée : le fichier dépasse 2 Mo.');
        return false;
      }
    }

    return true;
  };

  // Ajoutez des écouteurs pour les champs de fichier
  const cvFileInput = document.getElementById('cvFile');
  const coverLetterFileInput = document.getElementById('coverLetterFile');

  if (cvFileInput) {
    cvFileInput.addEventListener('change', () => validateFile(cvFileInput));
  }

  if (coverLetterFileInput) {
    coverLetterFileInput.addEventListener('change', () =>
      validateFile(coverLetterFileInput)
    );
  }

  // Fonction pour téléverser les fichiers
  const uploadFile = (fileInput, folder, newFileName) => {
    const file = fileInput.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('file', file);
    formData.append('folder', folder);
    formData.append('newFileName', newFileName);

    fetch('http://localhost:3000/upload', {
      // Update URL to use localhost
      method: 'POST',
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          console.log(`Fichier téléversé avec succès : ${newFileName}`);
        } else {
          console.error('Erreur lors du téléversement du fichier.');
        }
      })
      .catch((error) => {
        console.error('Erreur réseau lors du téléversement :', error);
      });
  };

  // Soumettre le formulaire de modification
  if (profileForm) {
    profileForm.addEventListener('submit', (event) => {
      event.preventDefault(); // Empêche le rechargement de la page

      const Name = document.getElementById('Name')?.value || '';
      const firstName = document.getElementById('firstName')?.value || '';
      const cvFileInput = document.getElementById('cvFile');
      const coverLetterFileInput = document.getElementById('coverLetterFile');

      // Téléversement des fichiers
      if (cvFileInput && cvFileInput.files.length > 0) {
        const cvFileName = `${Name}_${firstName}_CV.pdf`;
        uploadFile(cvFileInput, 'CV', cvFileName);
        document.getElementById('cvFileName').textContent = cvFileName;
      }

      if (coverLetterFileInput && coverLetterFileInput.files.length > 0) {
        const coverLetterFileName = `${Name}_${firstName}_LDM.pdf`;
        uploadFile(coverLetterFileInput, 'LDM', coverLetterFileName);
        document.getElementById('coverLetterFileName').textContent =
          coverLetterFileName;
      }

      // Mettre à jour les informations affichées
      document.getElementById('profileName').textContent = Name;
      document.getElementById('profileFirstName').textContent = firstName;
      document.getElementById('profileEmail').textContent =
        document.getElementById('email')?.value || '';
      document.getElementById('profilePhone').textContent =
        document.getElementById('phone')?.value || '';

      // Réinitialiser l'affichage
      document.getElementById('profileInfo').classList.remove('hidden');
      profileForm.classList.add('hidden');
      document.getElementById('editProfile').style.display = 'block';

      console.log('Profil mis à jour avec succès.');
    });
  }

  // Soumettre le formulaire de modification

  if (profileForm) {
    profileForm.addEventListener('submit', (event) => {
      if (!validateFile(cvFileInput) || !validateFile(coverLetterFileInput)) {
        event.preventDefault();
        console.log("Formulaire non soumis en raison d'erreurs de validation.");
      }
    });
  }

  // Ajoutez un événement pour les boutons "Postuler" dans le modal
  document.addEventListener('click', function (event) {
    const modalApplyButton = event.target.closest('#offerModal .btn-primary');
    if (modalApplyButton) {
      const offerTitle =
        document.getElementById('offerModalTitle')?.textContent ||
        'Offre inconnue';

      // Fermez le modal
      const modal = modalApplyButton.closest('.modal');
      if (modal) {
        modal.classList.remove('active');
      }

      // Changez l'état du bouton "Postuler" dans le modal
      modalApplyButton.style.backgroundColor = 'gray';
      modalApplyButton.style.cursor = 'not-allowed';
      modalApplyButton.disabled = true;

      // Changez l'état du bouton "Postuler" en dehors du modal
      const offerCards = document.querySelectorAll('.offer-card');
      offerCards.forEach((card) => {
        const cardTitle = card.querySelector('.offer-info h3')?.textContent;
        if (cardTitle === offerTitle) {
          const cardApplyButton = card.querySelector('.btn-primary');
          if (cardApplyButton) {
            cardApplyButton.style.backgroundColor = 'gray';
            cardApplyButton.style.cursor = 'not-allowed';
            cardApplyButton.disabled = true;
          }
        }
      });

      // Affichez une notification
      showNotification(`Vous avez postulé à "${offerTitle}".`);
    }
  });

  // Function to open the modal with offer details
  function openOfferModal(offer) {
    offerModalTitle.textContent = offer.title || 'Titre non disponible';
    offerModalCompany.textContent =
      offer.company?.company_name || 'Entreprise non spécifiée';
    offerModalLocation.textContent =
      offer.company?.city?.city_name || 'Localisation non spécifiée';
    offerModalSalary.textContent = offer.salary || 'Rémunération non spécifiée';
    offerModalDetails.textContent =
      offer.description || 'Description non disponible';

    // Show the modal
    offerModal.classList.add('active');
  }

  // Event listener for clicking on an offer card
  document.addEventListener('click', function (event) {
    const offerCard = event.target.closest('.offer-card');
    if (offerCard) {
      const offerId = offerCard.dataset.id;

      // Fetch offer details from the backend
      fetch(`/offers/${offerId}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.json();
        })
        .then((offer) => {
          openOfferModal(offer);
        })
        .catch((error) => {
          console.error('Error fetching offer details:', error);
          alert(
            "Une erreur est survenue lors de la récupération des détails de l'offre."
          );
        });
    }
  });
  // Close the modal when clicking outside the modal content
  document.querySelectorAll('.modal').forEach((modal) => {
    modal.addEventListener('click', function (event) {
      if (event.target === modal) {
        modal.classList.remove('active');
      }
    });
  });
  // Close the modal when clicking the close button
  document.querySelectorAll('.modal .close').forEach((closeButton) => {
    closeButton.addEventListener('click', function () {
      const modal = this.closest('.modal');
      if (modal) modal.classList.remove('active');
    });
  });
});
