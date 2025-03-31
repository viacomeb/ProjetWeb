<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur - StageManager</title>
    <link rel="stylesheet" href="../../../public/assets/css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Modals -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Gérer un utilisateur</h2>
            <form id="userForm">
                <div class="form-group">
                    <label for="userType">Type d'utilisateur</label>
                    <select id="userType" required>
                        <option value="">Sélectionner un type</option>
                        <option value="student">Étudiant</option>
                        <option value="pilot">Pilote</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="userName">Nom complet</label>
                    <input type="text" id="userName" required>
                </div>
                <div class="form-group">
                    <label for="userEmail">Email</label>
                    <input type="email" id="userEmail" required>
                </div>
                <div class="form-group">
                    <label for="userRole">Rôle</label>
                    <select id="userRole" required>
                        <option value="read">Lecture seule</option>
                        <option value="write">Lecture/Écriture</option>
                        <option value="admin">Administrateur</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                    <button type="button" class="btn-secondary modal-close">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>Admin Panel</span>
            </div>
            <ul class="nav-links">
                <li class="active" data-section="overview">
                    <i class="fas fa-home"></i>
                    <span>Vue d'ensemble</span>
                </li>
                <li data-section="companies">
                    <i class="fas fa-building"></i>
                    <span>Entreprises</span>
                </li>
                <li data-section="internships">
                    <i class="fas fa-briefcase"></i>
                    <span>Offres de stage</span>
                </li>
                <li data-section="pilots">
                    <i class="fas fa-user-tie"></i>
                    <span>Pilotes</span>
                </li>
                <li data-section="students">
                    <i class="fas fa-user-graduate"></i>
                    <span>Étudiants</span>
                </li>
                <li data-section="applications">
                    <i class="fas fa-file-alt"></i>
                    <span>Candidatures</span>
                </li>
                <li data-section="settings">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="user-menu">
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="badge">5</span>
                    </div>
                    <div class="profile">
                        <img src="https://ui-avatars.com/api/?name=Admin" alt="Profile">
                        <span>Administrateur</span>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Overview Section -->
                <section id="overview" class="section-content active">
                    <h1>Vue d'ensemble</h1>
                    <div class="stats-cards">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stat-details">
                                <h3>156</h3>
                                <p>Entreprises enregistrées</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="stat-details">
                                <h3>284</h3>
                                <p>Offres actives</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="stat-details">
                                <h3>523</h3>
                                <p>Étudiants inscrits</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-details">
                                <h3>78%</h3>
                                <p>Stages pourvus</p>
                            </div>
                        </div>
                    </div>

                    <div class="charts-container">
                        <div class="chart-card">
                            <h3>Top 5 entreprises</h3>
                            <canvas id="topCompaniesChart"></canvas>
                        </div>
                        <div class="chart-card">
                            <h3>Répartition par domaine</h3>
                            <canvas id="domainChart"></canvas>
                        </div>
                    </div>

                    <div class="recent-activities">
                        <h2>Activités récentes</h2>
                        <div class="activity-list">
                            <div class="activity-item">
                                <i class="fas fa-plus-circle"></i>
                                <div class="activity-details">
                                    <p>Nouvelle entreprise ajoutée : <strong>TechCorp</strong></p>
                                    <span>Il y a 1 heure</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <i class="fas fa-user-plus"></i>
                                <div class="activity-details">
                                    <p>Nouveau pilote créé : <strong>Jean Martin</strong></p>
                                    <span>Il y a 2 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <i class="fas fa-edit"></i>
                                <div class="activity-details">
                                    <p>Modification des permissions : <strong>Groupe Pilotes</strong></p>
                                    <span>Il y a 3 heures</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Companies Section -->
                <section id="companies" class="section-content">
                    <div class="section-header">
                        <h1>Gestion des Entreprises</h1>
                        <button class="btn-primary" id="addCompany">
                            <i class="fas fa-plus"></i> Nouvelle entreprise
                        </button>
                    </div>
                    <div class="filters">
                        <button class="filter-btn active">Toutes</button>
                        <button class="filter-btn">Tech</button>
                        <button class="filter-btn">Finance</button>
                        <button class="filter-btn">Marketing</button>
                    </div>
                    <div class="data-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Entreprise</th>
                                    <th>Secteur</th>
                                    <th>Offres actives</th>
                                    <th>Évaluation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="company-info">
                                            <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Company">
                                            <span>TechCorp</span>
                                        </div>
                                    </td>
                                    <td>Technologie</td>
                                    <td>12</td>
                                    <td>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <span>4.5/5</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="company-info">
                                            <img src="https://ui-avatars.com/api/?name=Data+Insight" alt="Company">
                                            <span>DataInsight</span>
                                        </div>
                                    </td>
                                    <td>Data Science</td>
                                    <td>8</td>
                                    <td>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <span>4.2/5</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Internships Section -->
                <section id="internships" class="section-content">
                    <div class="section-header">
                        <h1>Gestion des Offres</h1>
                        <button class="btn-primary" id="addInternship">
                            <i class="fas fa-plus"></i> Nouvelle offre
                        </button>
                    </div>
                    <div class="filters">
                        <button class="filter-btn active">Toutes</button>
                        <button class="filter-btn">En attente</button>
                        <button class="filter-btn">Validées</button>
                        <button class="filter-btn">Pourvues</button>
                    </div>
                    <div class="data-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Entreprise</th>
                                    <th>Candidatures</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Développeur Full-Stack</td>
                                    <td>
                                        <div class="company-info">
                                            <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Company">
                                            <span>TechCorp</span>
                                        </div>
                                    </td>
                                    <td>15</td>
                                    <td>
                                        <span class="status active">Active</span>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Data Analyst</td>
                                    <td>
                                        <div class="company-info">
                                            <img src="https://ui-avatars.com/api/?name=Data+Insight" alt="Company">
                                            <span>DataInsight</span>
                                        </div>
                                    </td>
                                    <td>8</td>
                                    <td>
                                        <span class="status pending">En attente</span>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Pilots Section -->
                <section id="pilots" class="section-content">
                    <div class="section-header">
                        <h1>Gestion des Pilotes</h1>
                        <button class="btn-primary" id="addPilot">
                            <i class="fas fa-plus"></i> Nouveau pilote
                        </button>
                    </div>
                    <div class="filters">
                        <button class="filter-btn active">Tous</button>
                        <button class="filter-btn">Actifs</button>
                        <button class="filter-btn">En congé</button>
                    </div>
                    <div class="data-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Étudiants</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <img src="https://ui-avatars.com/api/?name=Jean+Martin" alt="Pilot">
                                            <span>Jean Martin</span>
                                        </div>
                                    </td>
                                    <td>jean.martin@example.com</td>
                                    <td>45</td>
                                    <td>
                                        <span class="status active">Actif</span>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Students Section -->
                <section id="students" class="section-content">
                    <div class="section-header">
                        <h1>Gestion des Étudiants</h1>
                        <button class="btn-primary" id="addStudent">
                            <i class="fas fa-plus"></i> Nouvel étudiant
                        </button>
                    </div>
                    <div class="filters">
                        <button class="filter-btn active">Tous</button>
                        <button class="filter-btn">En recherche</button>
                        <button class="filter-btn">Stage trouvé</button>
                    </div>
                    <div class="data-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Pilote</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <img src="https://ui-avatars.com/api/?name=Marie+Martin" alt="Student">
                                            <span>Marie Martin</span>
                                        </div>
                                    </td>
                                    <td>marie.martin@example.com</td>
                                    <td>Jean Martin</td>
                                    <td>
                                        <span class="status searching">En recherche</span>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-icon" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Applications Section -->
                <section id="applications" class="section-content">
                    <div class="section-header">
                        <h1>Suivi des Candidatures</h1>
                    </div>
                    <div class="filters">
                        <button class="filter-btn active">Toutes</button>
                        <button class="filter-btn">En attente</button>
                        <button class="filter-btn">Acceptées</button>
                        <button class="filter-btn">Refusées</button>
                    </div>
                    <div class="data-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Entreprise</th>
                                    <th>Poste</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <img src="https://ui-avatars.com/api/?name=Marie+Martin" alt="Student">
                                            <span>Marie Martin</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="company-info">
                                            <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Company">
                                            <span>TechCorp</span>
                                        </div>
                                    </td>
                                    <td>Développeur Full-Stack</td>
                                    <td>
                                        <span class="status pending">En attente</span>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-icon" title="Voir CV">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                            <button class="btn-icon" title="Voir LM">
                                                <i class="fas fa-file-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Settings Section -->
                <section id="settings" class="section-content">
                    <h1>Paramètres</h1>
                    <div class="settings-grid">
                        <div class="settings-card">
                            <h3>Gestion des rôles</h3>
                            <div class="roles-list">
                                <div class="role-item">
                                    <div class="role-header">
                                        <h4>Administrateurs</h4>
                                        <span class="user-count">3 utilisateurs</span>
                                    </div>
                                    <div class="permissions">
                                        <label class="permission">
                                            <input type="checkbox" checked disabled>
                                            <span>Gestion des utilisateurs</span>
                                        </label>
                                        <label class="permission">
                                            <input type="checkbox" checked disabled>
                                            <span>Gestion des entreprises</span>
                                        </label>
                                        <label class="permission">
                                            <input type="checkbox" checked disabled>
                                            <span>Gestion des offres</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="role-item">
                                    <div class="role-header">
                                        <h4>Pilotes</h4>
                                        <span class="user-count">12 utilisateurs</span>
                                    </div>
                                    <div class="permissions">
                                        <label class="permission">
                                            <input type="checkbox" checked>
                                            <span>Gestion des étudiants</span>
                                        </label>
                                        <label class="permission">
                                            <input type="checkbox" checked>
                                            <span>Validation des offres</span>
                                        </label>
                                        <label class="permission">
                                            <input type="checkbox">
                                            <span>Gestion des entreprises</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="role-item">
                                    <div class="role-header">
                                        <h4>Étudiants</h4>
                                        <span class="user-count">523 utilisateurs</span>
                                    </div>
                                    <div class="permissions">
                                        <label class="permission">
                                            <input type="checkbox" checked>
                                            <span>Postuler aux offres</span>
                                        </label>
                                        <label class="permission">
                                            <input type="checkbox" checked>
                                            <span>Messagerie</span>
                                        </label>
                                        <label class="permission">
                                            <input type="checkbox">
                                            <span>Forum</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="settings-card">
                            <h3>Sécurité</h3>
                            <div class="security-settings">
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4>Double authentification</h4>
                                        <p>Exiger la 2FA pour les comptes administrateurs</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4>Journalisation</h4>
                                        <p>Activer la journalisation détaillée</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4>Politique de mot de passe</h4>
                                        <p>Exiger des mots de passe forts</p>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="settings-card">
                            <h3>RGPD</h3>
                            <div class="gdpr-settings">
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4>Conservation des données</h4>
                                        <p>Durée de conservation : 24 mois</p>
                                    </div>
                                    <button class="btn-secondary">Configurer</button>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4>Exports de données</h4>
                                        <p>Dernière exportation : 12/03/2024</p>
                                    </div>
                                    <button class="btn-secondary">Exporter</button>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-info">
                                        <h4>Demandes de suppression</h4>
                                        <p>2 demandes en attente</p>
                                    </div>
                                    <button class="btn-secondary">Gérer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <script src="../../../public/assets/js/admin_dashboard.js"></script>
</body>

</html>
