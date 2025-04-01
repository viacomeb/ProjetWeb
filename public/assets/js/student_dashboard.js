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

  // Theme Toggle
  const themeSwitch = document.getElementById('themeSwitch');
  const body = document.body;

  themeSwitch.addEventListener('change', function () {
    if (this.checked) {
      body.setAttribute('data-theme', 'dark');
      localStorage.setItem('theme', 'dark');
    } else {
      body.setAttribute('data-theme', 'light');
      localStorage.setItem('theme', 'light');
    }
  });

  // Check for saved theme preference
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    body.setAttribute('data-theme', savedTheme);
    themeSwitch.checked = savedTheme === 'dark';
  }

  // Quick Apply Functionality
  document.querySelectorAll('.quick-apply').forEach((button) => {
    button.addEventListener('click', function () {
      const jobTitle =
        this.closest('.job-card').querySelector('h3').textContent;
      const company =
        this.closest('.job-card').querySelector('.company').textContent;

      // Animation feedback
      this.textContent = 'Candidature envoyée !';
      this.style.backgroundColor = '#10b981';

      // Reset after 2 seconds
      setTimeout(() => {
        this.textContent = 'Postuler en 1 clic';
        this.style.backgroundColor = '';
      }, 2000);

      // Update XP (example)
      const xpCounter = document.querySelector('.xp-counter span');
      const currentXP = parseInt(xpCounter.textContent);
      xpCounter.textContent = `${currentXP + 50} XP`;

      // Show notification
      showNotification(
        `Candidature envoyée pour le poste de ${jobTitle} chez ${company}`
      );
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
});
