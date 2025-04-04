@extends('admin.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="internships" class="section-content active">
            <div class="section-header">
                <h1>Gestion des Offres</h1>
                <div class="search-bar">
                    <input type="text" id="offerSearch" placeholder="Rechercher une offre par titre..." />
                </div>
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
                            <tr class="offer-row" data-offer-id="{{ $offer->offer_id }}" style="cursor: pointer;">
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
    <div id="internshipModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter une offre de stage</h2>
            <form id="internshipForm" method="POST" action="{{ route('admin.internships.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Titre de l'offre :</label>
                    <input type="text" id="title" name="title" placeholder="Entrez le titre" required />
                </div>
                <div class="form-group">
                    <label for="companySearch">Rechercher une entreprise :</label>
                    <input type="text" id="companySearch" placeholder="Recherchez une entreprise" />
                    <ul id="companyDropdown" class="dropdown-menu" style="display: none;">
                        @foreach ($companies as $company)
                            <li class="dropdown-item" data-id="{{ $company->company_id }}">{{ $company->company_name }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" id="company_id" name="company_id" required />
                    <span id="selectedCompany" style="display: none;">Entreprise sélectionnée : </span>
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

    <!-- Modal for Viewing Offer Details -->
    <div id="offerDetailsModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" id="closeOfferDetailsModal">&times;</span>
            <h2 id="modalOfferTitle"></h2>
            <p><strong>Description :</strong> <span id="modalOfferDescription"></span></p>
            <p><strong>Salaire :</strong> <span id="modalOfferSalary"></span></p>
            <p><strong>Entreprise :</strong> <span id="modalOfferCompany"></span></p>
            <p><strong>Date de début :</strong> <span id="modalOfferStartDate"></span></p>
            <p><strong>Date de fin :</strong> <span id="modalOfferEndDate"></span></p>
        </div>
    </div>

    <!-- Modal for Editing Offer -->
    <div id="editInternshipModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" id="closeEditInternshipModal">&times;</span>
            <h2>Modifier une offre de stage</h2>
            <form id="editInternshipForm" method="POST">
                @csrf
                @method('PUT') <!-- Ensure the method is PUT -->
                <input type="hidden" id="edit_offer_id" name="offer_id" /> <!-- Ensure this field is included -->
                <div class="form-group">
                    <label for="edit_title">Titre de l'offre :</label>
                    <input type="text" id="edit_title" name="title" placeholder="Entrez le titre" required />
                </div>
                <div class="form-group">
                    <label for="edit_company">Entreprise :</label>
                    <input type="text" id="edit_company" placeholder="Nom de l'entreprise" disabled />
                    <input type="hidden" id="edit_company_id" name="company_id" />
                    <!-- Hidden field remains editable by JavaScript -->
                </div>
                <div class="form-group">
                    <label for="edit_description">Description de l'offre :</label>
                    <textarea id="edit_description" name="description" placeholder="Entrez la description"></textarea>
                </div>
                <div class="form-group">
                    <label for="edit_salary">Salaire :</label>
                    <input type="number" id="edit_salary" name="salary" step="50"
                        placeholder="Entrez le salaire" />
                </div>
                <div class="form-group">
                    <label for="edit_start_date">Date de début :</label>
                    <input type="date" id="edit_start_date" name="start_date" />
                </div>
                <div class="form-group">
                    <label for="edit_end_date">Date de fin :</label>
                    <input type="date" id="edit_end_date" name="end_date" />
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                    <button type="button" class="btn-secondary close">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Confirming Deletion -->
    <div id="confirmDeleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>Confirmer la suppression</h2>
            <p>Êtes-vous sûr de vouloir supprimer cette offre ? Cette action est irréversible.</p>
            <div class="modal-actions">
                <button id="confirmDeleteButton" class="btn-primary">Confirmer</button>
                <button id="cancelDeleteButton" class="btn-secondary">Annuler</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companySearch = document.getElementById('companySearch');
            const companyDropdown = document.getElementById('companyDropdown');
            const companyIdInput = document.getElementById('company_id');
            const selectedCompany = document.getElementById('selectedCompany');
            const dropdownItems = companyDropdown.querySelectorAll('.dropdown-item');

            // Filter dropdown items based on input
            companySearch.addEventListener('input', function() {
                const searchValue = companySearch.value.toLowerCase();
                let hasVisibleItems = false;

                dropdownItems.forEach(item => {
                    const itemText = item.textContent.toLowerCase();
                    if (itemText.includes(searchValue)) {
                        item.style.display = 'block';
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                companyDropdown.style.display = hasVisibleItems ? 'block' : 'none';
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!companySearch.contains(event.target) && !companyDropdown.contains(event.target)) {
                    companyDropdown.style.display = 'none';
                }
            });

            // Handle dropdown item selection
            companyDropdown.addEventListener('click', function(event) {
                if (event.target.classList.contains('dropdown-item')) {
                    const companyId = event.target.getAttribute('data-id');
                    const companyName = event.target.textContent;

                    companyIdInput.value = companyId;
                    selectedCompany.textContent = `Entreprise sélectionnée : ${companyName}`;
                    selectedCompany.style.display = 'block';
                    companyDropdown.style.display = 'none';
                    companySearch.value = '';
                }
            });

            const offerSearch = document.getElementById('offerSearch');
            const offerRows = document.querySelectorAll('.offer-row');

            // Filter offers based on search input
            offerSearch.addEventListener('input', function() {
                const searchValue = offerSearch.value.toLowerCase();

                offerRows.forEach(row => {
                    const title = row.querySelector('td:first-child').textContent.toLowerCase();
                    row.style.display = title.includes(searchValue) ? '' : 'none';
                });
            });

            const editButtons = document.querySelectorAll('.btn-icon[title="Modifier"]');
            const editModal = document.getElementById('editInternshipModal');
            const editForm = document.getElementById('editInternshipForm');

            editButtons.forEach((button) => {
                button.addEventListener('click', (event) => {
                    event.stopPropagation();

                    const offerRow = button.closest('.offer-row');
                    const offerId = offerRow.getAttribute('data-offer-id');

                    // Fetch additional data from the server
                    fetch(`/admin/internships/${offerId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to fetch offer details');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                                return;
                            }

                            // Populate the modal fields with the offer data
                            document.getElementById('edit_offer_id').value = data.offer_id ||
                                '';
                            document.getElementById('edit_title').value = data.title || '';
                            document.getElementById('edit_company').value = data.company_name ||
                                'Non spécifié';
                            document.getElementById('edit_company_id').value = data
                                .company_id || '';
                            document.getElementById('edit_description').value = data
                                .description || '';
                            document.getElementById('edit_salary').value = data.salary || '';
                            document.getElementById('edit_start_date').value = data
                                .start_date || '';
                            document.getElementById('edit_end_date').value = data.end_date ||
                                '';

                            // Set the form action dynamically
                            editForm.action = `/admin/internships/update/${offerId}`;

                            // Show the modal
                            editModal.style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Error fetching offer details:', error);
                            alert(
                                "Une erreur est survenue lors de la récupération des détails de l'offre."
                            );
                        });
                });
            });

            editForm.addEventListener('submit', (event) => {
                event.preventDefault(); // Prevent default form submission

                const title = document.getElementById('edit_title').value.trim();
                const companyId = document.getElementById('edit_company_id').value.trim();

                // Validate required fields
                if (!title) {
                    alert("Le champ 'Titre de l'offre' est requis.");
                    return;
                }
                if (!companyId) {
                    alert("Le champ 'Entreprise' est requis.");
                    return;
                }

                const formData = new FormData(editForm);
                const offerId = document.getElementById('edit_offer_id').value;

                fetch(`/admin/internships/update/${offerId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            title: document.getElementById('edit_title').value.trim(),
                            company_id: document.getElementById('edit_company_id').value.trim(),
                            description: document.getElementById('edit_description').value
                                .trim(),
                            salary: document.getElementById('edit_salary').value.trim(),
                            start_date: document.getElementById('edit_start_date').value.trim(),
                            end_date: document.getElementById('edit_end_date').value.trim(),
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => {
                                console.error('Server response:', text);
                                throw new Error(
                                    'Failed to update the offer. Please check the server response.'
                                );
                            });
                        }
                        return response.json();
                    })
                    .then(() => {
                        alert('Offre mise à jour avec succès.');
                        location.reload(); // Reload the page to reflect changes
                    })
                    .catch(error => {
                        console.error('Error updating the offer:', error);
                        alert("Une erreur est survenue : " + error.message);
                    });
            });

            const deleteButtons = document.querySelectorAll('.btn-icon[title="Supprimer"]');
            const deleteModal = document.getElementById('confirmDeleteModal');
            const confirmDeleteButton = document.getElementById('confirmDeleteButton');
            const cancelDeleteButton = document.getElementById('cancelDeleteButton');
            let formToSubmit = null;

            deleteButtons.forEach((button) => {
                button.addEventListener('click', (event) => {
                    event.stopPropagation(); // Prevent triggering row click event

                    const offerRow = button.closest('.offer-row');
                    const offerId = offerRow.getAttribute('data-offer-id');

                    // Create a temporary form for deletion
                    formToSubmit = document.createElement('form');
                    formToSubmit.method = 'POST';
                    formToSubmit.action = `/admin/internships/delete/${offerId}`;
                    formToSubmit.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(formToSubmit);

                    // Show the confirmation modal
                    deleteModal.style.display = 'block';
                });
            });

            confirmDeleteButton.addEventListener('click', () => {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });

            cancelDeleteButton.addEventListener('click', () => {
                deleteModal.style.display = 'none';
                if (formToSubmit) {
                    formToSubmit.remove();
                    formToSubmit = null;
                }
            });

            window.addEventListener('click', (event) => {
                if (event.target === deleteModal) {
                    deleteModal.style.display = 'none';
                    if (formToSubmit) {
                        formToSubmit.remove();
                        formToSubmit = null;
                    }
                }
            });

            const closeEditModal = document.getElementById('closeEditInternshipModal');
            const cancelEditButton = editModal.querySelector(
                '.btn-secondary.close'); // Ensure this targets the correct button

            // Close modal when clicking the "Annuler" button
            cancelEditButton.addEventListener('click', () => {
                editModal.style.display = 'none';
            });

            // Close modal when clicking the close icon
            closeEditModal.addEventListener('click', () => {
                editModal.style.display = 'none';
            });

            // Close modal when clicking outside the modal content
            window.addEventListener('click', (event) => {
                if (event.target === editModal) {
                    editModal.style.display = 'none';
                }
            });
        });
    </script>

@endsection
