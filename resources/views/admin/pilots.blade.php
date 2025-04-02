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
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pilots as $pilot)
                            <tr>
                                <td>{{ $pilot->first_name }} {{ $pilot->last_name }}</td>
                                <td>{{ $pilot->email }}</td>
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
            <form id="userForm" method="POST" action="{{ route('admin.pilots.store') }}">
                @csrf
                <div id="pilotSection">
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="pilotFirstName">Prénom du pilote :</label>
                            <input type="text" id="pilotFirstName" name="first_name"
                                placeholder="Entrez le prénom du pilote" required />
                        </div>
                        <div class="form-group">
                            <label for="pilotLastName">Nom du pilote :</label>
                            <input type="text" id="pilotLastName" name="last_name" placeholder="Entrez le nom du pilote"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pilotEmail">Email du pilote :</label>
                        <input type="email" id="pilotEmail" name="email" placeholder="Entrez l'email du pilote"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="pilotPassword">Mot de passe :</label>
                        <input type="password" id="pilotPassword" name="password" placeholder="Entrez un mot de passe"
                            required />
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="pilotStreetNumber">Numéro de rue :</label>
                            <input type="number" id="pilotStreetNumber" name="street_number"
                                placeholder="Entrez le numéro de rue" />
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
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
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
@endsection
