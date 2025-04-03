@extends('pilots.app')

@section('title', ucfirst($page))

@section('content')
<!-- Dashboard Content -->
<div class="dashboard-content">
    <section id="applications" class="section-content active">
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
                            <div class="student-info">
                                <span>Alice Dupont</span>
                            </div>
                        </td>
                        <td>TechCorp</td>
                        <td>Développeur Full-Stack</td>
                        <td>
                            <span class="status accepted">Acceptée</span>
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
                            <div class="student-info">
                                <span>Bob Martin</span>
                            </div>
                        </td>
                        <td>DataInsight</td>
                        <td>Data Analyst</td>
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
</div>
<!-- Modal for Adding/Editing Applications -->
<div id="applicationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Ajouter une candidature</h2>
        <form id="applicationForm">
            <div class="form-group">
                <label for="student">Étudiant :</label>
                <input type="text" id="student" placeholder="Entrez le nom de l'étudiant" />
            </div>
            <div class="form-group">
                <label for="company">Entreprise :</label>
                <input type="text" id="company" placeholder="Entrez le nom de l'entreprise" />
            </div>
            <div class="form-group">
                <label for="position">Poste :</label>
                <input type="text" id="position" placeholder="Entrez le poste" />
            </div>
            <div class="form-group">
                <label for="status">Statut :</label>
                <select id="status">
                    <option value="pending">En attente</option>
                    <option value="accepted">Acceptée</option>
                    <option value="rejected">Refusée</option>
                </select>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn-primary">Ajouter</button>
                <button type="button" class="btn-secondary close">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>
</main>
</div>
@endsection
