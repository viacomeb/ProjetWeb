@extends('admin.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="companies" class="section-content active">
            <div class="section-header">
                <h1>Gestion des Entreprises</h1>
                <button class="btn btn-primary" id="addCompany">
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
                            <th>Description</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    <div class="company-info">
                                        <span>{{ $company->company_name }}</span>
                                    </div>
                                </td>
                                <td>{{ Str::limit($company->description, 50) }}</td>
                                <!-- Limiter la description à 50 caractères -->
                                <td>{{ preg_replace('/\s+/', '', $company->phone) }}</td>
                                <!-- Supprimer les espaces dans le numéro de téléphone -->
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->street_number }} {{ $company->street }}</td>
                                <td>{{ $company->city->city_name }}</td>
                                <td>
                                    <div class="actions">
                                        <button class="btn-icon" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST"
                                            action="{{ route('admin.companies.destroy', $company->company_id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon delete" title="Supprimer"
                                                data-id="{{ $company->company_id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $companies->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
    <div id="companyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter une entreprise</h2>
            <form id="companyForm" method="POST" action="{{ route('admin.companies.store') }}">
                @csrf
                <div class="form-group">
                    <label for="companyName">Nom de l'entreprise :</label>
                    <input type="text" id="companyName" name="company_name" placeholder="Entrez le nom" required />
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" placeholder="Entrez une description"></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone :</label>
                    <input type="text" id="phone" name="phone" placeholder="Entrez le téléphone" />
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Entrez l'email" />
                </div>
                <div class="form-group">
                    <label for="street">Rue :</label>
                    <input type="text" id="street" name="street" placeholder="Entrez la rue" />
                </div>
                <div class="form-group">
                    <label for="streetNumber">Numéro de rue :</label>
                    <input type="number" id="streetNumber" name="street_number" placeholder="Entrez le numéro de rue" />
                </div>
                <div class="form-group">
                    <label for="cityName">Ville :</label>
                    <input type="text" id="cityName" name="city_name" placeholder="Entrez la ville" required />
                </div>
                <div class="form-group">
                    <label for="postalCode">Code postal :</label>
                    <input type="number" id="postalCode" name="postal_code" placeholder="Entrez le code postal" required />
                </div>
                <div class="form-group">
                    <label for="departmentName">Département :</label>
                    <input type="text" id="departmentName" name="department_name" placeholder="Entrez le département"
                        required />
                </div>
                <div class="form-group">
                    <label for="countryName">Pays :</label>
                    <input type="text" id="countryName" name="country_name" placeholder="Entrez le pays" required />
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Ajouter</button>
                    <button type="button" class="btn-secondary close">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Ajout d'un modal de confirmation de suppression -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirmer la suppression</h2>
            <p>Êtes-vous sûr de vouloir supprimer cet élément ?</p>
            <div class="modal-actions">
                <button class="btn-secondary close">Annuler</button>
                <button class="btn-primary confirm-delete">Confirmer</button>
            </div>
        </div>
    </div>

    <!-- Ajout d'un script pour gérer l'ouverture et la fermeture du modal -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.btn-icon.delete');
            const deleteModal = document.getElementById('deleteModal');
            const closeModalButtons = deleteModal.querySelectorAll('.close');
            const confirmDeleteButton = deleteModal.querySelector('.confirm-delete');

            let formToSubmit = null;

            deleteButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    formToSubmit = button.closest('form');
                    deleteModal.classList.add('active');
                });
            });

            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    deleteModal.classList.remove('active');
                });
            });

            confirmDeleteButton.addEventListener('click', () => {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });
        });
    </script>
@endsection
