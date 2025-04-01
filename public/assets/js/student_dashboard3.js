document.addEventListener('DOMContentLoaded', function () {
  // Theme Toggle
  const themeToggle = document.querySelector('.theme-toggle');
  themeToggle.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
    const icon = this.querySelector('i');
    if (document.body.classList.contains('dark-mode')) {
      icon.classList.remove('fa-moon');
      icon.classList.add('fa-sun');
    } else {
      icon.classList.remove('fa-sun');
      icon.classList.add('fa-moon');
    }
  });

  // Notifications Popup
  const notifications = document.querySelector('.notifications');
  const notificationsPopup = document.querySelector('.notifications-popup');
  notifications.addEventListener('click', function (e) {
    e.stopPropagation();
    notificationsPopup.style.display =
      notificationsPopup.style.display === 'block' ? 'none' : 'block';
  });

  // Profile Menu
  const profile = document.querySelector('.profile');
  const profileMenu = document.querySelector('.profile-menu');
  profile.addEventListener('click', function (e) {
    e.stopPropagation();
    profileMenu.style.display =
      profileMenu.style.display === 'block' ? 'none' : 'block';
  });

  // Music Player
  const musicPlayer = document.querySelector('.music-player');
  const musicPopup = document.querySelector('.music-popup');
  musicPlayer.addEventListener('click', function (e) {
    e.stopPropagation();
    musicPopup.style.display =
      musicPopup.style.display === 'block' ? 'none' : 'block';
  });

  // Close popups when clicking outside
  document.addEventListener('click', function () {
    notificationsPopup.style.display = 'none';
    profileMenu.style.display = 'none';
    musicPopup.style.display = 'none';
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

  // Music options
  document.querySelectorAll('.music-option').forEach((option) => {
    option.addEventListener('click', function () {
      // TODO: Implement music playback
      console.log('Playing:', this.textContent);
    });
  });

  // Apply/Save buttons
  document.querySelectorAll('.btn-primary').forEach((btn) => {
    btn.addEventListener('click', function () {
      // TODO: Implement respective actions
      console.log('Action:', this.textContent);
    });
  });

  // Progress animations
  document.querySelectorAll('.progress').forEach((progress) => {
    const width = progress.style.width;
    progress.style.width = '0';
    setTimeout(() => {
      progress.style.width = width;
    }, 100);
  });

  // Bookmark functionality
  document.querySelectorAll('.btn-secondary').forEach((btn) => {
    btn.addEventListener('click', function () {
      const icon = this.querySelector('i');
      if (icon.classList.contains('fa-bookmark')) {
        icon.classList.remove('fa-bookmark');
        icon.classList.add('fa-bookmark-solid');
      } else {
        icon.classList.remove('fa-bookmark-solid');
        icon.classList.add('fa-bookmark');
      }
    });
  });

  // Search functionality
  const searchInput = document.querySelector('.search-bar input');
  searchInput.addEventListener('input', function (e) {
    // TODO: Implement search functionality
    console.log('Search:', e.target.value);
  });

  // Initialize tooltips
  const tooltips = document.querySelectorAll('[data-tooltip]');
  tooltips.forEach((tooltip) => {
    tooltip.addEventListener('mouseenter', function () {
      const tip = document.createElement('div');
      tip.className = 'tooltip';
      tip.textContent = this.dataset.tooltip;
      document.body.appendChild(tip);

      const rect = this.getBoundingClientRect();
      tip.style.top = rect.bottom + 5 + 'px';
      tip.style.left = rect.left + (rect.width - tip.offsetWidth) / 2 + 'px';
    });

    tooltip.addEventListener('mouseleave', function () {
      const tip = document.querySelector('.tooltip');
      if (tip) tip.remove();
    });
  });
});

// Simulated streak counter
let streakCount = 5;
let streakDate = new Date();

function updateStreak() {
  const today = new Date();
  const diffDays = Math.floor((today - streakDate) / (1000 * 60 * 60 * 24));

  if (diffDays > 1) {
    streakCount = 0;
  } else if (diffDays === 1) {
    streakCount++;
    streakDate = today;
  }

  const streakElement = document.querySelector('.streak span');
  if (streakElement) {
    streakElement.textContent = `${streakCount} jours`;
  }
}

// Update streak daily
setInterval(updateStreak, 1000 * 60 * 60); // Check every hour

// XP System
let userXP = 1250;
const xpLevels = {
  1: 0,
  2: 500,
  3: 1000,
  4: 2000,
  5: 3500,
};

function getCurrentLevel() {
  let level = 1;
  for (const [lvl, xp] of Object.entries(xpLevels)) {
    if (userXP >= xp) level = parseInt(lvl);
  }
  return level;
}

function addXP(amount) {
  const oldLevel = getCurrentLevel();
  userXP += amount;
  const newLevel = getCurrentLevel();

  if (newLevel > oldLevel) {
    // Level up notification
    showNotification(
      `Félicitations ! Vous avez atteint le niveau ${newLevel} !`
    );
  }

  updateXPDisplay();
}

function updateXPDisplay() {
  const xpElement = document.querySelector('.profile-info p');
  if (xpElement) {
    xpElement.textContent = `Niveau ${getCurrentLevel()} - ${userXP} XP`;
  }
}

function showNotification(message) {
  const notification = document.createElement('div');
  notification.className = 'notification-toast';
  notification.textContent = message;
  document.body.appendChild(notification);

  setTimeout(() => {
    notification.remove();
  }, 3000);
}

// Challenge system
const challenges = {
  daily: [
    {
      id: 'apply3',
      title: 'Postuler à 3 offres',
      xp: 50,
      progress: 0,
      max: 3,
    },
    {
      id: 'updateCV',
      title: 'Mettre à jour son CV',
      xp: 30,
      progress: 1,
      max: 1,
    },
    {
      id: 'forum',
      title: 'Participer au forum',
      xp: 70,
      progress: 0,
      max: 1,
    },
  ],
};

function updateChallenge(challengeId, progress) {
  const challenge = challenges.daily.find((c) => c.id === challengeId);
  if (challenge) {
    challenge.progress = Math.min(challenge.max, challenge.progress + progress);
    if (challenge.progress === challenge.max) {
      addXP(challenge.xp);
      showNotification(`Challenge complété ! +${challenge.xp} XP`);
    }
    updateChallengeDisplay();
  }
}

function updateChallengeDisplay() {
  challenges.daily.forEach((challenge) => {
    const element = document.querySelector(
      `[data-challenge="${challenge.id}"]`
    );
    if (element) {
      const progress = element.querySelector('.progress');
      const progressText = element.querySelector('.challenge-text p');

      progress.style.width = `${(challenge.progress / challenge.max) * 100}%`;
      progressText.textContent = `${challenge.progress}/${challenge.max} complétés`;
    }
  });
}
