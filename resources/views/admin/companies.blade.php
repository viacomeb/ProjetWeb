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
                    <label for="sector">Secteur :</label>
                    <input type="text" id="sector" name="sector" placeholder="Entrez le secteur" required />
                </div>
                <div class="form-group">
                    <label for="address">Adresse :</label>
                    <div class="address-group">
                        <div class="form-group">
                            <label for="streetNumber">Numéro de rue :</label>
                            <input type="text" id="streetNumber" name="street_number" placeholder="Ex : 123" required />
                        </div>
                        <div class="form-group">
                            <label for="streetName">Nom de la rue :</label>
                            <input type="text" id="streetName" name="street" placeholder="Ex : Rue de Paris" required />
                        </div>
                        <div class="form-group">
                            <label for="city">Ville :</label>
                            <input type="text" id="city" name="city_name" placeholder="Ex : Paris" required />
                        </div>
                        <div class="form-group">
                            <label for="postalCode">Code postal :</label>
                            <input type="text" id="postalCode" name="postal_code" placeholder="Ex : 75000" required />
                        </div>
                        <div class="form-group">
                            <label for="country">Pays :</label>
                            <input type="text" id="country" name="country_name" placeholder="Ex : France" required />
                        </div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Ajouter</button>
                    <button type="button" class="btn-secondary close">Annuler</button>
                </div>
            </form>
        </div>
    </div>
    </main>
    </div>
@endsection
