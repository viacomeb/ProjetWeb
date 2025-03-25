<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pilotes</title>
    <link rel="icon" href="../../../public/assets/images/WorknGo_logo.svg">
    <link rel="stylesheet" href="../../../public/assets/css/pilotes_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Modals -->
    <div id="companyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Gérer une entreprise</h2>
            <form id="companyForm">
                <div class="form-group">
                    <label for="companyName">Nom de l'entreprise</label>
                    <input type="text" id="companyName" required>
                </div>
                <div class="form-group">
                    <label for="companySector">Secteur d'activité</label>
                    <input type="text" id="companySector" required>
                </div>
                <div class="form-group">
                    <label for="companyDescription">Description</label>
                    <textarea id="companyDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="companyWebsite">Site web</label>
                    <input type="url" id="companyWebsite">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                    <button type="button" class="btn-secondary modal-close">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <div id="internshipModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Gérer une offre de stage</h2>
            <form id="internshipForm">
                <div class="form-group">
                    <label for="internshipTitle">Titre du stage</label>
                    <input type="text" id="internshipTitle" required>
                </div>
                <div class="form-group">
                    <label for="internshipCompany">Entreprise</label>
                    <select id="internshipCompany" required>
                        <option value="">Sélectionner une entreprise</option>
                        <option value="1">TechCorp</option>
                        <option value="2">DataInsight</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="internshipDescription">Description</label>
                    <textarea id="internshipDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="internshipDuration">Durée (mois)</label>
                    <input type="number" id="internshipDuration" min="1" max="12" required>
                </div>
                <div class="form-group">
                    <label for="internshipSkills">Compétences requises</label>
                    <input type="text" id="internshipSkills" placeholder="Séparées par des virgules">
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
                <i class="fas fa-graduation-cap"></i>
                <span>WorknGo</span>
            </div>
            <ul class="nav-links">
                <li class="active" data-section="overview">
                    <i class="fas fa-home"></i>
                    <span>Vue d'ensemble</span>
                </li>
                <li data-section="students">
                    <i class="fas fa-users"></i>
                    <span>Étudiants</span>
                </li>
                <li data-section="internships">
                    <i class="fas fa-briefcase"></i>
                    <span>Offres de stage</span>
                </li>
                <li data-section="companies">
                    <i class="fas fa-building"></i>
                    <span>Entreprises</span>
                </li>
                <li data-section="stats">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistiques</span>
                </li>
                <li data-section="messages">
                    <i class="fas fa-envelope"></i>
                    <span>Messagerie</span>
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
                        <span class="badge">3</span>
                    </div>
                    <div class="profile">
                        <img src="https://ui-avatars.com/api/?name=Jean+Dupont" alt="Profile">
                        <span>Jean Dupont</span>
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
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="stat-details">
                                <h3>45</h3>
                                <p>Étudiants en recherche</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-details">
                                <h3>65%</h3>
                                <p>Taux de placement</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="stat-details">
                                <h3>28</h3>
                                <p>Offres actives</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-details">
                                <h3>12</h3>
                                <p>Entretiens cette semaine</p>
                            </div>
                        </div>
                    </div>

                    <div class="charts-container">
                        <div class="chart-card">
                            <h3>Répartition des stages par compétence</h3>
                            <canvas id="skillsChart"></canvas>
                        </div>
                        <div class="chart-card">
                            <h3>Progression des placements</h3>
                            <canvas id="progressChart"></canvas>
                        </div>
                    </div>

                    <div class="recent-activities">
                        <h2>Activités récentes</h2>
                        <div class="activity-list">
                            <div class="activity-item">
                                <i class="fas fa-file-alt"></i>
                                <div class="activity-details">
                                    <p>Nouvelle candidature de <strong>Marie Martin</strong></p>
                                    <span>Il y a 2 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <i class="fas fa-building"></i>
                                <div class="activity-details">
                                    <p>Nouvelle offre de stage chez <strong>TechCorp</strong></p>
                                    <span>Il y a 3 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <i class="fas fa-check-circle"></i>
                                <div class="activity-details">
                                    <p><strong>Lucas Dubois</strong> a trouvé son stage</p>
                                    <span>Il y a 5 heures</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Students Section -->
                <section id="students" class="section-content">
                    <h1>Gestion des Étudiants</h1>
                    <div class="filters">
                        <button class="filter-btn active">Tous</button>
                        <button class="filter-btn">En recherche</button>
                        <button class="filter-btn">Stage trouvé</button>
                        <button class="filter-btn">Pas commencé</button>
                    </div>
                    <div class="students-list">
                        <div class="student-card">
                            <img src="https://ui-avatars.com/api/?name=Marie+Martin" alt="Student" class="student-avatar">
                            <div class="student-info">
                                <h3>Marie Martin</h3>
                                <p class="status searching">En recherche</p>
                                <p>5 candidatures envoyées</p>
                                <div class="student-actions">
                                    <button class="btn-primary"><i class="fas fa-eye"></i> Voir profil</button>
                                    <button class="btn-secondary"><i class="fas fa-envelope"></i> Message</button>
                                </div>
                            </div>
                            <div class="application-progress">
                                <div class="progress-item">
                                    <span class="label">Candidatures</span>
                                    <span class="value">5</span>
                                </div>
                                <div class="progress-item">
                                    <span class="label">Entretiens</span>
                                    <span class="value">2</span>
                                </div>
                                <div class="progress-item">
                                    <span class="label">En attente</span>
                                    <span class="value">3</span>
                                </div>
                            </div>
                        </div>
                        <div class="student-card">
                            <img src="https://ui-avatars.com/api/?name=Lucas+Dubois" alt="Student" class="student-avatar">
                            <div class="student-info">
                                <h3>Lucas Dubois</h3>
                                <p class="status placed">Stage trouvé</p>
                                <p>Stage chez TechCorp</p>
                                <div class="student-actions">
                                    <button class="btn-primary"><i class="fas fa-eye"></i> Voir profil</button>
                                    <button class="btn-secondary"><i class="fas fa-envelope"></i> Message</button>
                                </div>
                            </div>
                            <div class="application-progress">
                                <div class="progress-item success">
                                    <span class="label">Entreprise</span>
                                    <span class="value">TechCorp</span>
                                </div>
                                <div class="progress-item success">
                                    <span class="label">Début</span>
                                    <span class="value">03/04/24</span>
                                </div>
                                <div class="progress-item success">
                                    <span class="label">Durée</span>
                                    <span class="value">6 mois</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Internships Section -->
                <section id="internships" class="section-content">
                    <h1>Offres de Stage</h1>
                    <div class="section-header">
                        <div class="filters">
                            <button class="filter-btn active">Toutes les offres</button>
                            <button class="filter-btn">Nouvelles</button>
                            <button class="filter-btn">En cours</button>
                            <button class="filter-btn">Pourvues</button>
                        </div>
                        <button class="btn-primary" id="addInternship">
                            <i class="fas fa-plus"></i> Nouvelle offre
                        </button>
                    </div>
                    <div class="internships-list">
                        <div class="internship-card">
                            <div class="company-logo">
                                <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Company">
                            </div>
                            <div class="internship-details">
                                <h3>Développeur Full-Stack</h3>
                                <p class="company-name">TechCorp</p>
                                <div class="tags">
                                    <span class="tag">React</span>
                                    <span class="tag">Node.js</span>
                                    <span class="tag">6 mois</span>
                                </div>
                                <p class="description">Stage de développement web avec stack moderne...</p>
                                <div class="internship-stats">
                                    <span><i class="fas fa-users"></i> 8 candidatures</span>
                                    <span><i class="fas fa-clock"></i> Publié il y a 2 jours</span>
                                </div>
                            </div>
                            <div class="internship-actions">
                                <button class="btn-primary edit-internship"><i class="fas fa-edit"></i> Modifier</button>
                                <button class="btn-secondary delete-internship"><i class="fas fa-trash"></i> Supprimer</button>
                            </div>
                        </div>
                        <div class="internship-card">
                            <div class="company-logo">
                                <img src="https://ui-avatars.com/api/?name=Data+Insight" alt="Company">
                            </div>
                            <div class="internship-details">
                                <h3>Data Analyst</h3>
                                <p class="company-name">DataInsight</p>
                                <div class="tags">
                                    <span class="tag">Python</span>
                                    <span class="tag">SQL</span>
                                    <span class="tag">4 mois</span>
                                </div>
                                <p class="description">Analyse de données et création de dashboards...</p>
                                <div class="internship-stats">
                                    <span><i class="fas fa-users"></i> 5 candidatures</span>
                                    <span><i class="fas fa-clock"></i> Publié il y a 5 jours</span>
                                </div>
                            </div>
                            <div class="internship-actions">
                                <button class="btn-primary edit-internship"><i class="fas fa-edit"></i> Modifier</button>
                                <button class="btn-secondary delete-internship"><i class="fas fa-trash"></i> Supprimer</button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Companies Section -->
                <section id="companies" class="section-content">
                    <h1>Entreprises Partenaires</h1>
                    <div class="section-header">
                        <div class="filters">
                            <button class="filter-btn active">Toutes</button>
                            <button class="filter-btn">Actives</button>
                            <button class="filter-btn">Nouveaux partenaires</button>
                        </div>
                        <button class="btn-primary" id="addCompany">
                            <i class="fas fa-plus"></i> Nouvelle entreprise
                        </button>
                    </div>
                    <div class="companies-list">
                        <div class="company-card">
                            <div class="company-header">
                                <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Company" class="company-logo">
                                <div class="company-info">
                                    <h3>TechCorp</h3>
                                    <p>Développement logiciel</p>
                                    <div class="company-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(4.5/5)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="company-stats">
                                <div class="stat">
                                    <span class="value">12</span>
                                    <span class="label">Stagiaires accueillis</span>
                                </div>
                                <div class="stat">
                                    <span class="value">3</span>
                                    <span class="label">Offres actives</span>
                                </div>
                                <div class="stat">
                                    <span class="value">85%</span>
                                    <span class="label">Taux de satisfaction</span>
                                </div>
                            </div>
                            <div class="company-actions">
                                <button class="btn-primary edit-company"><i class="fas fa-edit"></i> Modifier</button>
                                <button class="btn-secondary delete-company"><i class="fas fa-trash"></i> Supprimer</button>
                            </div>
                        </div>
                        <div class="company-card">
                            <div class="company-header">
                                <img src="https://ui-avatars.com/api/?name=Data+Insight" alt="Company" class="company-logo">
                                <div class="company-info">
                                    <h3>DataInsight</h3>
                                    <p>Analyse de données</p>
                                    <div class="company-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <span>(4.0/5)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="company-stats">
                                <div class="stat">
                                    <span class="value">8</span>
                                    <span class="label">Stagiaires accueillis</span>
                                </div>
                                <div class="stat">
                                    <span class="value">2</span>
                                    <span class="label">Offres actives</span>
                                </div>
                                <div class="stat">
                                    <span class="value">90%</span>
                                    <span class="label">Taux de satisfaction</span>
                                </div>
                            </div>
                            <div class="company-actions">
                                <button class="btn-primary edit-company"><i class="fas fa-edit"></i> Modifier</button>
                                <button class="btn-secondary delete-company"><i class="fas fa-trash"></i> Supprimer</button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Statistics Section -->
                <section id="stats" class="section-content">
                    <h1>Statistiques</h1>
                    <div class="stats-grid">
                        <div class="stat-card wide">
                            <h3>Évolution des placements</h3>
                            <canvas id="placementTrendChart"></canvas>
                        </div>
                        <div class="stat-card">
                            <h3>Répartition par secteur</h3>
                            <canvas id="sectorChart"></canvas>
                        </div>
                        <div class="stat-card">
                            <h3>Durée moyenne des stages</h3>
                            <canvas id="durationChart"></canvas>
                        </div>
                        <div class="stat-card wide">
                            <h3>Taux de conversion des candidatures</h3>
                            <canvas id="conversionChart"></canvas>
                        </div>
                    </div>
                    <div class="stats-summary">
                        <div class="summary-card">
                            <h4>Taux de réussite global</h4>
                            <div class="progress-circle" data-value="85">
                                <span class="progress-value">85%</span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <h4>Moyenne des rémunérations</h4>
                            <p class="big-number">1250€</p>
                            <p class="trend positive">+8% vs N-1</p>
                        </div>
                        <div class="summary-card">
                            <h4>Délai moyen de placement</h4>
                            <p class="big-number">45j</p>
                            <p class="trend negative">+5j vs N-1</p>
                        </div>
                    </div>
                </section>

                <!-- Messages Section -->
                <section id="messages" class="section-content">
                    <h1>Messagerie</h1>
                    <div class="messaging-container">
                        <div class="contacts-list">
                            <div class="search-messages">
                                <input type="text" placeholder="Rechercher une conversation...">
                            </div>
                            <div class="contact active">
                                <img src="https://ui-avatars.com/api/?name=Marie+Martin" alt="Contact">
                                <div class="contact-info">
                                    <h4>Marie Martin</h4>
                                    <p>Merci pour l'information sur...</p>
                                </div>
                                <div class="contact-meta">
                                    <span class="time">14:23</span>
                                    <span class="unread">2</span>
                                </div>
                            </div>
                            <div class="contact">
                                <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Contact">
                                <div class="contact-info">
                                    <h4>TechCorp RH</h4>
                                    <p>Concernant la candidature de...</p>
                                </div>
                                <div class="contact-meta">
                                    <span class="time">Hier</span>
                                </div>
                            </div>
                            <div class="contact">
                                <img src="https://ui-avatars.com/api/?name=Lucas+Dubois" alt="Contact">
                                <div class="contact-info">
                                    <h4>Lucas Dubois</h4>
                                    <p>J'ai bien reçu le contrat...</p>
                                </div>
                                <div class="contact-meta">
                                    <span class="time">Lun</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat-container">
                            <div class="chat-header">
                                <img src="https://ui-avatars.com/api/?name=Marie+Martin" alt="Contact">
                                <div class="chat-contact-info">
                                    <h4>Marie Martin</h4>
                                    <p>En ligne</p>
                                </div>
                            </div>
                            <div class="messages">
                                <div class="message received">
                                    <p>Bonjour, j'ai une question concernant l'offre de stage chez TechCorp</p>
                                    <span class="time">14:20</span>
                                </div>
                                <div class="message sent">
                                    <p>Bien sûr, que souhaitez-vous savoir ?</p>
                                    <span class="time">14:21</span>
                                </div>
                                <div class="message received">
                                    <p>Est-ce que le télétravail est possible ?</p>
                                    <span class="time">14:22</span>
                                </div>
                                <div class="message sent">
                                    <p>Oui, l'entreprise propose 2 jours de télétravail par semaine.</p>
                                    <span class="time">14:23</span>
                                </div>
                            </div>
                            <div class="message-input">
                                <input type="text" placeholder="Écrivez votre message...">
                                <button class="send-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <script src="../../../public/assets/js/pilotes_dashboard.js"></script>
</body>

</html>
