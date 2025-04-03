@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => 'resources/css/admin_dashboard.css'])
@endpush

@section('content')
    <!-- Dashboard Content -->
    <section class="about-section">
        <div class="dashboard-content">
            <section id="companies" class="section-content active">
                <div class="section-header">
                    <h1>Liste des entreprises</h1>
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
    </section>


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

            const editButtons = document.querySelectorAll('.btn-icon[title="Modifier"]');
            const editModal = document.getElementById('editCompanyModal');
            const closeModalButtonsEdit = editModal.querySelectorAll('.close');
            const editForm = document.getElementById('editCompanyForm');

            editButtons.forEach(button => {
                button.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const companyId = button.closest('tr').querySelector('form button').dataset
                        .id;

                    try {
                        // Fetch company data from the server
                        const response = await fetch(`/companies/${companyId}`);
                        if (!response.ok) {
                            throw new Error('Failed to fetch company data');
                        }

                        const company = await response.json();

                        // Populate modal fields with fetched data
                        editForm.action = `/companies/${companyId}`;
                        document.getElementById('editCompanyId').value = companyId;
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
        });
    </script>

    @vite('resources/js/admin_dashboard.js')
@endsection
