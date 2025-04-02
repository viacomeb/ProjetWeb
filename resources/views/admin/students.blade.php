@extends('admin.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="students" class="section-content active">
            <div class="section-header">
                <h1>Gestion des Étudiants</h1>
                <button class="btn btn-primary" id="addStudent">
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
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->email }}</td>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $students->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
    <div id="studentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter un étudiant</h2>
            <form id="studentForm">
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="studentFirstName">Prénom de l'étudiant :</label>
                        <input type="text" id="studentFirstName" placeholder="Entrez le prénom" />
                    </div>
                    <div class="form-group">
                        <label for="studentLastName">Nom de l'étudiant :</label>
                        <input type="text" id="studentLastName" placeholder="Entrez le nom" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" placeholder="Entrez l'email" />
                </div>
                <div class="form-group">
                    <label for="studentSearch">Rechercher un étudiant :</label>
                    <input type="text" id="studentSearch" placeholder="Recherchez un étudiant" />
                    <ul id="studentDropdown" class="dropdown-menu" style="display: none">
                        <!-- Liste des étudiants générée dynamiquement -->
                    </ul>
                    <p id="selectedstudent" style="margin-top: 10px; font-weight: bold"></p>
                </div>
                <div class="form-group">
                    <label for="status">Statut :</label>
                    <select id="status">
                        <option value="searching">En recherche</option>
                        <option value="found">Stage trouvé</option>
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
