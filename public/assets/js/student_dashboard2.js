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
      console.log(`Navigating to section: ${sectionId}`); // Debug: Log the section ID
      document.getElementById(sectionId).classList.add('active');
    });
  });

  // Apply/Save buttons
  document.querySelectorAll('.btn-primary').forEach((btn) => {
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

  const offers = [
    // Exemple de données d'offres
    {
      title: 'Développeur Full-Stack',
      company: 'TechCorp',
      location: 'Paris (Hybride)',
      salary: '1000€ - 1200€',
    },
    {
      title: 'Data Analyst',
      company: 'DataInsight',
      location: 'Lyon (Remote)',
      salary: '800€ - 1000€',
    },
    // Ajoutez plus d'offres ici...
  ];

  const offersPerPage = 10;
  let currentPage = 1;

  function renderOffers(page) {
    const offersGrid = document.getElementById('offersGrid');
    offersGrid.innerHTML = '';

    const start = (page - 1) * offersPerPage;
    const end = start + offersPerPage;
    const paginatedOffers = offers.slice(start, end);

    paginatedOffers.forEach((offer) => {
      const offerCard = document.createElement('div');
      offerCard.className = 'offer-card';
      offerCard.innerHTML = `
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
          <button class="btn-secondary"><i class="fas fa-bookmark"></i> Ajouter aux favoris</button>
        </div>
      `;
      offersGrid.appendChild(offerCard);
    });
  }

  function renderPagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const totalPages = Math.ceil(offers.length / offersPerPage);

    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement('button');
      button.textContent = i;
      button.className = i === currentPage ? 'active' : '';
      button.addEventListener('click', () => {
        currentPage = i;
        renderOffers(currentPage);
        renderPagination();
      });
      pagination.appendChild(button);
    }
  }

  // Initial rendering
  renderOffers(currentPage);
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
      `;

      // Ajouter un événement pour retirer l'offre de la wishlist
      const wishlistButton = offerCard.querySelector('.btn-secondary');
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

  // Ajoutez un événement pour gérer le bouton "Wishlist" dans les offres
  document.addEventListener('click', function (event) {
    if (event.target.closest('.btn-secondary')) {
      const offerCard = event.target.closest('.offer-card');
      const offer = {
        title: offerCard.querySelector('.offer-info h3').textContent,
        company: offerCard.querySelector('.offer-info p').textContent,
        location: offerCard.querySelector('.offer-details p:nth-child(1)')
          .textContent,
        salary: offerCard.querySelector('.offer-details p:nth-child(2)')
          .textContent,
      };
      toggleWishlist(offer, event.target.closest('.btn-secondary'));
    }
  });

  // Initial rendering for wishlist
  renderWishlist(currentWishlistPage);
  renderWishlistPagination();
});
