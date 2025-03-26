<?php

// Sample data queries (in a real app, these would fetch from database)
$jobs = [
    [
        'id' => 1,
        'title' => "Senior Frontend Developer",
        'status' => "active",
        'views' => 450,
        'applications' => 32,
        'publishedAt' => "2024-03-01",
        'department' => "Engineering",
        'location' => "Paris"
    ],
    [
        'id' => 2,
        'title' => "UX Designer",
        'status' => "active",
        'views' => 380,
        'applications' => 28,
        'publishedAt' => "2024-02-28",
        'department' => "Design",
        'location' => "Lyon"
    ],
    [
        'id' => 3,
        'title' => "Product Manager",
        'status' => "closed",
        'views' => 420,
        'applications' => 25,
        'publishedAt' => "2024-02-15",
        'department' => "Product",
        'location' => "Remote"
    ]
];

$candidates = [
    [
        'id' => 1,
        'name' => "Sophie Martin",
        'email' => "sophie.martin@email.com",
        'status' => "in_progress",
        'appliedAt' => "2024-03-01",
        'jobTitle' => "Senior Frontend Developer",
        'avatar' => "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150"
    ],
    [
        'id' => 2,
        'name' => "Thomas Bernard",
        'email' => "thomas.bernard@email.com",
        'status' => "pending",
        'appliedAt' => "2024-02-29",
        'jobTitle' => "UX Designer",
        'avatar' => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150"
    ]
];

// Helper function to format dates
function formatDate($dateString)
{
    setlocale(LC_TIME, 'fr_FR.utf8');
    $date = new DateTime($dateString);
    return strftime("%d %B %Y", $date->getTimestamp());
}

// Get current active tab
$activeTab = $_GET['tab'] ?? 'overview';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecrutPro - Dashboard</title>
    <link rel="stylesheet" href="../../..//public/assets/css/companies_dashboard.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <div class="app">
        <!-- Header -->
        <header class="header">
            <div class="container header-content">
                <div class="logo">
                    <i data-lucide="building-2" class="logo-icon"></i>
                    <span class="logo-text">workngo</span>
                </div>

                <div class="header-actions">
                    <button class="btn btn-primary">
                        <i data-lucide="plus"></i>
                        Créer une offre
                    </button>

                    <div class="search-container">
                        <input type="text" placeholder="Rechercher des candidats..." class="search-input">
                        <i data-lucide="search" class="search-icon"></i>
                    </div>

                    <button class="btn-icon notification-btn">
                        <i data-lucide="bell"></i>
                        <span class="notification-badge">3</span>
                    </button>

                    <div class="profile-menu">
                        <button class="btn-icon profile-btn" id="profileBtn">
                            <i data-lucide="user-circle"></i>
                            <i data-lucide="chevron-down"></i>
                        </button>
                        <div class="profile-dropdown" id="profileDropdown">
                            <a href="#" class="dropdown-item">Paramètres</a>
                            <a href="#" class="dropdown-item">Équipe</a>
                            <a href="#" class="dropdown-item">Abonnement</a>
                            <a href="#" class="dropdown-item">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main container">
            <!-- Navigation Tabs -->
            <div class="tabs">
                <a href="?tab=overview" class="tab-btn <?php echo $activeTab === 'overview' ? 'active' : ''; ?>">
                    Vue d'ensemble
                </a>
                <a href="?tab=jobs" class="tab-btn <?php echo $activeTab === 'jobs' ? 'active' : ''; ?>">
                    Offres
                </a>
                <a href="?tab=candidates" class="tab-btn <?php echo $activeTab === 'candidates' ? 'active' : ''; ?>">
                    Candidats
                </a>
            </div>

            <!-- Overview Tab -->
            <?php if ($activeTab === 'overview'): ?>
                <div class="tab-content active">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-header">
                                <h3>Vues totales</h3>
                                <i data-lucide="eye"></i>
                            </div>
                            <p class="stat-value">1250</p>
                        </div>

                        <div class="stat-card">
                            <div class="stat-header">
                                <h3>Candidatures</h3>
                                <i data-lucide="file-text"></i>
                            </div>
                            <p class="stat-value">85</p>
                        </div>

                        <div class="stat-card">
                            <div class="stat-header">
                                <h3>Taux de conversion</h3>
                                <i data-lucide="line-chart"></i>
                            </div>
                            <p class="stat-value">6.8%</p>
                        </div>

                        <div class="stat-card">
                            <div class="stat-header">
                                <h3>Offres actives</h3>
                                <i data-lucide="briefcase"></i>
                            </div>
                            <p class="stat-value">12</p>
                        </div>
                    </div>

                    <div class="popular-jobs">
                        <div class="popular-jobs-header">
                            <h3>
                                <i data-lucide="trending-up"></i>
                                Offres populaires
                            </h3>
                        </div>
                        <div class="jobs-list">
                            <?php foreach ($jobs as $job): ?>
                                <div class="job-card">
                                    <div class="job-card-header">
                                        <div>
                                            <h4 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h4>
                                            <div class="job-stats">
                                                <span class="job-stat">
                                                    <i data-lucide="eye"></i>
                                                    <?php echo $job['views']; ?> vues
                                                </span>
                                                <span class="job-stat">
                                                    <i data-lucide="users"></i>
                                                    <?php echo $job['applications']; ?> candidats
                                                </span>
                                            </div>
                                        </div>
                                        <span class="status-badge <?php echo $job['status']; ?>">
                                            <?php echo $job['status']; ?>
                                        </span>
                                    </div>
                                    <div class="job-stats">
                                        <span class="job-stat">
                                            <i data-lucide="briefcase"></i>
                                            <?php echo htmlspecialchars($job['department']); ?>
                                        </span>
                                        <span class="job-stat">
                                            <i data-lucide="map-pin"></i>
                                            <?php echo htmlspecialchars($job['location']); ?>
                                        </span>
                                    </div>
                                    <div class="job-date">
                                        Publié le <?php echo formatDate($job['publishedAt']); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Jobs Tab -->
            <?php if ($activeTab === 'jobs'): ?>
                <div class="tab-content active">
                    <div class="section-header">
                        <h2>Gestion des offres</h2>
                        <div class="header-actions">
                            <button class="btn btn-outline">
                                <i data-lucide="filter"></i>
                                Filtrer
                            </button>
                            <button class="btn btn-primary">
                                <i data-lucide="plus"></i>
                                Nouvelle offre
                            </button>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="jobs-table">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Date</th>
                                    <th>Vues</th>
                                    <th>Candidatures</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jobs as $job): ?>
                                    <tr>
                                        <td class="font-medium"><?php echo htmlspecialchars($job['title']); ?></td>
                                        <td><?php echo formatDate($job['publishedAt']); ?></td>
                                        <td><?php echo $job['views']; ?></td>
                                        <td><?php echo $job['applications']; ?></td>
                                        <td>
                                            <span class="status-badge <?php echo $job['status']; ?>">
                                                <?php echo $job['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn-icon">
                                                <i data-lucide="edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Candidates Tab -->
            <?php if ($activeTab === 'candidates'): ?>
                <div class="tab-content active">
                    <div class="section-header">
                        <h2>Gestion des candidatures</h2>
                        <button class="btn btn-outline">
                            <i data-lucide="filter"></i>
                            Filtrer
                        </button>
                    </div>

                    <div class="candidates-list">
                        <?php foreach ($candidates as $candidate): ?>
                            <div class="candidate-card">
                                <div class="candidate-header">
                                    <div class="candidate-info">
                                        <img src="<?php echo htmlspecialchars($candidate['avatar']); ?>"
                                            alt="<?php echo htmlspecialchars($candidate['name']); ?>"
                                            class="candidate-avatar">
                                        <div class="candidate-details">
                                            <h4><?php echo htmlspecialchars($candidate['name']); ?></h4>
                                            <p><?php echo htmlspecialchars($candidate['email']); ?></p>
                                            <p>Pour: <?php echo htmlspecialchars($candidate['jobTitle']); ?></p>
                                        </div>
                                    </div>
                                    <div class="candidate-actions">
                                        <button class="action-btn accept" title="Accepter">
                                            <i data-lucide="check-circle"></i>
                                        </button>
                                        <button class="action-btn reject" title="Refuser">
                                            <i data-lucide="x-circle"></i>
                                        </button>
                                        <button class="action-btn message" title="Message">
                                            <i data-lucide="message-square"></i>
                                        </button>
                                        <button class="action-btn schedule" title="Planifier">
                                            <i data-lucide="calendar"></i>
                                        </button>
                                    </div>
                                </div>
                                <span class="status-badge <?php echo $candidate['status']; ?>">
                                    <?php echo $candidate['status']; ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script src="../../../public/assets/js/companies_dashboard.js"></script>
</body>

</html>
