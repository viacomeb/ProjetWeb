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
                            <tr class="company-row">
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
                                        <form method="GET"
                                            action="{{ route('admin.companies.update', $company->company_id) }}"
                                            style="display:inline;">
                                            @csrf
                                            <button class="btn-icon" class="btn-icon edit" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
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

    <!-- Modal for editing a company -->
    <div id="editCompanyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modifier une entreprise</h2>
            <form id="editCompanyForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="editCompanyId" name="company_id">
                <div class="form-group">
                    <label for="editCompanyName">Nom de l'entreprise :</label>
                    <input type="text" id="editCompanyName" name="company_name" placeholder="Entrez le nom"
                        required />
                </div>
                <div class="form-group">
                    <label for="editDescription">Description :</label>
                    <textarea id="editDescription" name="description" placeholder="Entrez une description"></textarea>
                </div>
                <div class="form-group">
                    <label for="editPhone">Téléphone :</label>
                    <input type="text" id="editPhone" name="phone" placeholder="Entrez le téléphone" />
                </div>
                <div class="form-group">
                    <label for="editEmail">Email :</label>
                    <input type="email" id="editEmail" name="email" placeholder="Entrez l'email" />
                </div>
                <div class="form-group">
                    <label for="editStreet">Rue :</label>
                    <input type="text" id="editStreet" name="street" placeholder="Entrez la rue" />
                </div>
                <div class="form-group">
                    <label for="editStreetNumber">Numéro de rue :</label>
                    <input type="number" id="editStreetNumber" name="street_number"
                        placeholder="Entrez le numéro de rue" />
                </div>
                <div class="form-group">
                    <label for="editCityName">Ville :</label>
                    <input type="text" id="editCityName" name="city_name" placeholder="Entrez la ville" required />
                </div>
                <div class="form-group">
                    <label for="editPostalCode">Code postal :</label>
                    <input type="number" id="editPostalCode" name="postal_code" placeholder="Entrez le code postal"
                        required />
                </div>
                <div class="form-group">
                    <label for="editDepartmentName">Département :</label>
                    <input type="text" id="editDepartmentName" name="department_name"
                        placeholder="Entrez le département" required />
                </div>
                <div class="form-group">
                    <label for="editCountryName">Pays :</label>
                    <input type="text" id="editCountryName" name="country_name" placeholder="Entrez le pays"
                        required />
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                    <button type="button" class="btn-secondary close">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for viewing company details -->
    <div id="viewCompanyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Détails de l'entreprise</h2>
            <div class="company-details">
                <p><strong>Nom :</strong> <span id="viewCompanyName"></span></p>
                <p><strong>Description :</strong> <span id="viewDescription"></span></p>
                <p><strong>Téléphone :</strong> <span id="viewPhone"></span></p>
                <p><strong>Email :</strong> <span id="viewEmail"></span></p>
                <p><strong>Adresse :</strong> <span id="viewAddress"></span></p>
                <p><strong>Ville :</strong> <span id="viewCity"></span></p>
                <p><strong>Code postal :</strong> <span id="viewPostalCode"></span></p>
                <p><strong>Département :</strong> <span id="viewDepartment"></span></p>
                <p><strong>Pays :</strong> <span id="viewCountry"></span></p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-secondary close">Fermer</button>
            </div>
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
    <style>
        .company-row {
            cursor: pointer;
        }
    </style>

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

            const editButtons = document.querySelectorAll('.btn-icon[title="Modifier"]');
            const editModal = document.getElementById('editCompanyModal');
            const closeModalButtonsEdit = editModal.querySelectorAll('.close');
            const editForm = document.getElementById('editCompanyForm');

            editButtons.forEach(button => {
                button.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const companyId = button.closest('tr').querySelector('.delete').dataset.id;

                    try {
                        // Fetch company data from the server
                        const response = await fetch(`/admin/companies/${companyId}`);
                        if (!response.ok) {
                            throw new Error('Failed to fetch company data');
                        }

                        const company = await response.json();

                        // Populate modal fields with fetched data
                        editForm.action = `/admin/companies/update/${companyId}`;
                        document.getElementById('editCompanyId').value = company.company_id;
                        document.getElementById('editCompanyName').value = company.company_name;
                        document.getElementById('editDescription').value = company
                            .description || '';
                        document.getElementById('editPhone').value = company.phone || '';
                        document.getElementById('editEmail').value = company.email || '';
                        document.getElementById('editStreet').value = company.street || '';
                        document.getElementById('editStreetNumber').value = company
                            .street_number || '';
                        document.getElementById('editCityName').value = company.city
                            .city_name || '';
                        document.getElementById('editPostalCode').value = company.city
                            .postal_code || '';
                        document.getElementById('editDepartmentName').value = company.city
                            .department.department_name || '';
                        document.getElementById('editCountryName').value = company.city
                            .department.country.country_name || '';

                        editModal.classList.add('active');
                    } catch (error) {
                        console.error('Error fetching company data:', error);
                        alert(
                            'Une erreur est survenue lors de la récupération des données de l\'entreprise.'
                        );
                    }
                });
            });

            closeModalButtonsEdit.forEach(button => {
                button.addEventListener('click', () => {
                    editModal.classList.remove('active');
                });
            });

            const companyRows = document.querySelectorAll('.company-row');
            const viewModal = document.getElementById('viewCompanyModal');
            const closeModalButtonsView = viewModal.querySelectorAll('.close');
            let isFetching = false; // Prevent multiple simultaneous requests

            companyRows.forEach(row => {
                row.addEventListener('click', async (e) => {
                    // Prevent triggering if the click is on a button inside the row
                    if (e.target.closest('.btn-icon')) return;

                    e.preventDefault();
                    if (isFetching) return; // Skip if a request is already in progress
                    isFetching = true;

                    const companyId = row.querySelector('.delete').dataset.id;

                    try {
                        // Fetch company data from the server
                        const response = await fetch(`/admin/companies/${companyId}`);
                        if (!response.ok) {
                            throw new Error('Failed to fetch company data');
                        }

                        const company = await response.json();

                        // Populate modal fields with fetched data
                        document.getElementById('viewCompanyName').textContent = company
                            .company_name || '';
                        document.getElementById('viewDescription').textContent = company
                            .description || '';
                        document.getElementById('viewPhone').textContent = company.phone || '';
                        document.getElementById('viewEmail').textContent = company.email || '';
                        document.getElementById('viewAddress').textContent =
                            `${company.street_number || ''} ${company.street || ''}`;
                        document.getElementById('viewCity').textContent = company.city
                            .city_name || '';
                        document.getElementById('viewPostalCode').textContent = company.city
                            .postal_code || '';
                        document.getElementById('viewDepartment').textContent = company.city
                            .department.department_name || '';
                        document.getElementById('viewCountry').textContent = company.city
                            .department.country.country_name || '';

                        viewModal.classList.add('active');
                    } catch (error) {
                        console.error('Error fetching company data:', error);
                        alert(
                            'Une erreur est survenue lors de la récupération des données de l\'entreprise.');
                    } finally {
                        isFetching = false; // Reset fetching state
                    }
                });
            });

            closeModalButtonsView.forEach(button => {
                button.addEventListener('click', () => {
                    viewModal.classList.remove('active');
                });
            });
        });
    </script>
@endsection
