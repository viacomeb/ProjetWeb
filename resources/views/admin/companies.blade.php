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
                            <th>Secteur</th>
                            <th>Offres actives</th>
                            <th>Évaluation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="company-info">
                                    <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Company" />
                                    <span>TechCorp</span>
                                </div>
                            </td>
                            <td>Technologie</td>
                            <td>12</td>
                            <td>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>4.5/5</span>
                                </div>
                            </td>
                            <td>
                                <div class="actions">
                                    <button class="btn-icon" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="showPopup()" class="btn-icon" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="company-info">
                                    <img src="https://ui-avatars.com/api/?name=Data+Insight" alt="Company" />
                                    <span>DataInsight</span>
                                </div>
                            </td>
                            <td>Data Science</td>
                            <td>8</td>
                            <td>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>4.2/5</span>
                                </div>
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
    <div id="companyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter une entreprise</h2>
            <form id="companyForm">
                <div class="form-group">
                    <label for="companyName">Nom de l'entreprise :</label>
                    <input type="text" id="companyName" placeholder="Entrez le nom" />
                </div>
                <div class="form-group">
                    <label for="sector">Secteur :</label>
                    <input type="text" id="sector" placeholder="Entrez le secteur" />
                </div>
                <div class="form-group">
                    <label for="address">Adresse :</label>
                    <div class="address-group">
                        <div class="form-group">
                            <label for="streetNumber">Numéro de rue :</label>
                            <input type="text" id="streetNumber" placeholder="Ex : 123" />
                        </div>
                        <div class="form-group">
                            <label for="streetName">Nom de la rue :</label>
                            <input type="text" id="streetName" placeholder="Ex : Rue de Paris" />
                        </div>
                        <div class="form-group">
                            <label for="city">Ville :</label>
                            <input type="text" id="city" placeholder="Ex : Paris" />
                        </div>
                        <div class="form-group">
                            <label for="postalCode">Code postal :</label>
                            <input type="text" id="postalCode" placeholder="Ex : 75000" />
                        </div>
                        <div class="form-group">
                            <label for="country">Pays :</label>
                            <input type="text" id="country" placeholder="Ex : France" />
                        </div>
                    </div>
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
