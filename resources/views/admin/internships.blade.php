@extends('admin.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="internships" class="section-content active">
            <div class="section-header">
                <h1>Gestion des Offres</h1>
                <button class="btn btn-primary" id="addInternship">
                    <i class="fas fa-plus"></i> Nouvelle offre
                </button>
            </div>
            <div class="filters">
                <button class="filter-btn">Toutes</button>
                <button class="filter-btn">Actives</button>
                <button class="filter-btn">Inactives</button>
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
                        @foreach ($offers as $offer)
                            <tr>
                                <td>{{ $offer->title }}</td>
                                <td>{{ $offer->company->company_name ?? 'Non spécifié' }}</td>
                                <td>{{ $offer->applications_count ?? 0 }}</td>
                                <td>
                                    <span class="status {{ $offer->is_active ? 'active' : 'inactive' }}">
                                        {{ $offer->is_active ? 'Active' : 'Inactive' }}
                                    </span>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $offers->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
    </main>
    </div>
    <div id="internshipModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter une offre de stage</h2>
            <form id="internshipForm" method="POST" action="{{ route('admin.internships.store') }}">
                @csrf

                @php
                    $companies = \App\Models\Company::select('company_id', 'company_name')->get();
                @endphp

                <div class="form-group">
                    <label for="title">Titre de l'offre :</label>
                    <input type="text" id="title" name="title" placeholder="Entrez le titre" required />
                </div>
                <div class="form-group">
                    <label for="companySearch">Rechercher une entreprise :</label>
                    <input type="text" id="companySearch" placeholder="Recherchez une entreprise" />
                    <ul id="companyDropdown" class="dropdown-menu" style="display: none">
                        @foreach ($companies as $company)
                            <li class="dropdown-item" data-id="{{ $company->company_id }}">{{ $company->company_name }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" id="company_id" name="company_id" required />
                    <p id="selectedCompany" style="margin-top: 10px; font-weight: bold"></p>
                </div>
                <div class="form-group">
                    <label for="description">Description de l'offre :</label>
                    <textarea id="description" name="description" placeholder="Entrez la description"></textarea>
                </div>
                <div class="form-group">
                    <label for="skills">Rechercher des compétences :</label>
                    <input type="text" id="skillsSearch" placeholder="Recherchez des compétences" />
                    <ul id="skillsDropdown" class="dropdown-menu" style="display: none">
                        <!-- Liste des compétences générée dynamiquement -->
                    </ul>
                </div>
                <div class="form-group">
                    <label>Compétences sélectionnées :</label>
                    <table id="selectedSkillsTable" class="data-table">
                        <thead>
                            <tr>
                                <th>Compétence</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Compétences sélectionnées affichées ici -->
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="salary">Salaire :</label>
                    <input type="number" id="salary" name="salary" step="50" placeholder="Entrez le salaire" />
                </div>
                <div class="form-group">
                    <label for="start_date">Date de début :</label>
                    <input type="date" id="start_date" name="start_date" />
                </div>
                <div class="form-group">
                    <label for="end_date">Date de fin :</label>
                    <input type="date" id="end_date" name="end_date" />
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Ajouter</button>
                    <button type="button" class="btn-secondary close">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>

    </script>
@endsection
