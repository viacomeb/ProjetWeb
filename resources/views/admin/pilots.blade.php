@extends('admin.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="overview" class="section-content">
            <!-- Contenu de la section Vue d'ensemble -->
        </section>
        <section id="companies" class="section-content">
            <!-- Contenu de la section Entreprises -->
        </section>
        <section id="internships" class="section-content">
            <!-- Contenu de la section Offres de stage -->
        </section>
        <section id="pilots" class="section-content active">
            <div class="section-header">
                <h1>Gestion des Pilotes</h1>
                <button class="btn btn-primary" id="addPilot">
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
                            <td>Jean Martin</td>
                            <td>jean.martin@example.com</td>
                            <td>25</td>
                            <td>
                                <span class="status active">Actif</span>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="btn-icon modify" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Marie Dupont</td>
                            <td>marie.dupont@example.com</td>
                            <td>30</td>
                            <td>
                                <span class="status on-leave">En congé</span>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="btn-icon modify" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section id="students" class="section-content">
            <!-- Contenu de la section Étudiants -->
        </section>
        <section id="applications" class="section-content">
            <!-- Contenu de la section Candidatures -->
        </section>
        <section id="settings" class="section-content">
            <!-- Contenu de la section Paramètres -->
        </section>
    </div>
    </main>
    </div>
    <!-- Modale pour ajouter un pilote -->
    <div id="pilotModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter un pilote</h2>
            <form id="userForm">
                <div id="pilotSection">
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="pilotFirstName">Prénom du pilote :</label>
                            <input type="text" id="pilotFirstName" placeholder="Entrez le prénom du pilote" />
                        </div>
                        <div class="form-group">
                            <label for="pilotLastName">Nom du pilote :</label>
                            <input type="text" id="pilotLastName" placeholder="Entrez le nom du pilote" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pilotEmail">Email du pilote :</label>
                        <input type="email" id="pilotEmail" placeholder="Entrez l'email du pilote" />
                    </div>
                    <div class="form-group">
                        <label for="studentSearch">Rechercher des étudiants :</label>
                        <input type="text" id="studentSearch" placeholder="Recherchez des étudiants par nom" />
                        <ul id="studentDropdown" class="dropdown-menu" style="display: none">
                            <!-- Liste des étudiants générée dynamiquement -->
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Étudiants associés :</label>
                        <table id="selectedStudentsTable" class="data-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Étudiants sélectionnés affichés ici -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Ajouter</button>
                    <button type="button" class="btn-secondary close">Annuler</button>
                </div>
            </form>
        </div>
    </div>
@endsection
