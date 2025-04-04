@extends('admin.app')

@section('title', ucfirst($page))

@push('scripts')
<script>
    let currentPilotId = null;

    function openEditPilotModal(pilotId) {
        currentPilotId = pilotId;
        const modal = document.getElementById('editPilotModal');
        const modalContent = document.getElementById('editPilotModalContent');

        fetch(`/admin/pilots/${pilotId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch pilot data');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('editPilotFirstName').value = data.pilot.user.first_name;
                document.getElementById('editPilotLastName').value = data.pilot.user.last_name;
                document.getElementById('editPilotEmail').value = data.pilot.user.email;
                document.getElementById('editPilotStreetNumber').value = data.pilot.user.street_number || '';
                document.getElementById('editPilotStreet').value = data.pilot.user.street || '';
                document.getElementById('editPilotCity').value = data.pilot.user.city_id;

                modal.classList.add('active');
            })
            .catch(error => {
                console.error('Error loading pilot data:', error);
                showNotification('Une erreur est survenue lors du chargement des données du pilote.', 'error');
            });
    }

    function deletePilot(pilotId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce pilote ?')) {
            fetch(`/admin/pilots/destroy/${pilotId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.error || 'Une erreur est survenue');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    showNotification('Pilote supprimé avec succès');
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification(error.message || 'Une erreur est survenue', 'error');
                });
        }
    }

    document.getElementById('editPilotForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        fetch(`/admin/pilots/update/${currentPilotId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.error || 'Une erreur est survenue');
                    });
                }
                return response.json();
            })
            .then(data => {
                showNotification('Pilote mis à jour avec succès');
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification(error.message || 'Une erreur est survenue', 'error');
            });
    });

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Fermer les modals en cliquant en dehors
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.classList.remove('active');
        }
    });

    // Fermer les modals avec le bouton close
    document.querySelectorAll('.close').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.modal').classList.remove('active');
        });
    });
</script>
@endpush

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
            <div class="search-bar">
                <input type="text" id="searchPilot" placeholder="Rechercher un pilote..." />
            </div>
            <button class="btn btn-primary" id="addPilot">
                <i class="fas fa-plus"></i> Nouveau pilote
            </button>
        </div>
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="pilotTableBody">
                    @foreach ($pilots as $pilot)
                    <tr>
                        <td>{{ $pilot->first_name }} {{ $pilot->last_name }}</td>
                        <td>{{ $pilot->email }}</td>
                        <td>
                            <div class="actions">
                                <button class="btn-icon modify" title="Modifier" onclick="openEditPilotModal({{ $pilot->pilot_id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon delete" title="Supprimer" onclick="deletePilot({{ $pilot->pilot_id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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

<!-- Modal pour ajouter un pilote -->
<div id="pilotModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Ajouter un pilote</h2>
        <form id="userForm" method="POST" action="{{ route('admin.pilots.store') }}">
            @csrf
            <div id="pilotSection">
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="pilotFirstName">Prénom du pilote :</label>
                        <input type="text" id="pilotFirstName" name="first_name" placeholder="Entrez le prénom du pilote" required />
                    </div>
                    <div class="form-group">
                        <label for="pilotLastName">Nom du pilote :</label>
                        <input type="text" id="pilotLastName" name="last_name" placeholder="Entrez le nom du pilote" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="pilotEmail">Email du pilote :</label>
                    <input type="email" id="pilotEmail" name="email" placeholder="Entrez l'email du pilote" required />
                </div>
                <div class="form-group">
                    <label for="pilotPassword">Mot de passe :</label>
                    <input type="password" id="pilotPassword" name="password" placeholder="Entrez un mot de passe" required />
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="pilotStreetNumber">Numéro de rue :</label>
                        <input type="number" id="pilotStreetNumber" name="street_number" placeholder="Entrez le numéro de rue" />
                    </div>
                    <div class="form-group">
                        <label for="pilotStreet">Rue :</label>
                        <input type="text" id="pilotStreet" name="street" placeholder="Entrez la rue" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="pilotCity">Ville :</label>
                    <select id="pilotCity" name="city_id" required>
                        @foreach ($cities as $city)
                        <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn-primary">Ajouter</button>
                <button type="button" class="btn-secondary close">Annuler</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal pour modifier un pilote -->
<div id="editPilotModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier un pilote</h2>
        <form id="editPilotForm">
            @csrf
            @method('PUT')
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="editPilotFirstName">Prénom du pilote :</label>
                    <input type="text" id="editPilotFirstName" name="first_name" placeholder="Entrez le prénom du pilote" required />
                </div>
                <div class="form-group">
                    <label for="editPilotLastName">Nom du pilote :</label>
                    <input type="text" id="editPilotLastName" name="last_name" placeholder="Entrez le nom du pilote" required />
                </div>
            </div>
            <div class="form-group">
                <label for="editPilotEmail">Email du pilote :</label>
                <input type="email" id="editPilotEmail" name="email" placeholder="Entrez l'email du pilote" required />
            </div>
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="editPilotStreetNumber">Numéro de rue :</label>
                    <input type="number" id="editPilotStreetNumber" name="street_number" placeholder="Entrez le numéro de rue" />
                </div>
                <div class="form-group">
                    <label for="editPilotStreet">Rue :</label>
                    <input type="text" id="editPilotStreet" name="street" placeholder="Entrez la rue" />
                </div>
            </div>
            <div class="form-group">
                <label for="editPilotCity">Ville :</label>
                <select id="editPilotCity" name="city_id" required>
                    @foreach ($cities as $city)
                    <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn-primary">Mettre à jour</button>
                <button type="button" class="btn-secondary close">Annuler</button>
            </div>
        </form>
    </div>
</div>
@endsection
