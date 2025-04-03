@extends('students.app')

@section('title', 'Offres de Stage')

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <!-- Internships Section -->
        <section id="internships" class="section-content active">
            <div class="section-header">
                <h1>Gestion des Offres</h1>
            </div>
            <div class="filters">
                <button class="filter-btn active">Toutes</button>
                <button class="filter-btn">En attente</button>
                <button class="filter-btn">Validées</button>
                <button class="filter-btn">Pourvues</button>
            </div>
            <div class="offers-grid" id="offersGrid">
                <!-- Les offres seront générées dynamiquement ici -->
            </div>
            <div class="pagination" id="pagination">
                <!-- Les boutons de pagination seront générés dynamiquement ici -->
            </div>
        </section>

        <div id="offerModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="offerModalTitle"></h2>
                <div class="form-group">
                    <strong>Entreprise:</strong>
                    <p id="offerModalCompany"></p>
                </div>
                <div class="form-group">
                    <strong>Localisation:</strong>
                    <p id="offerModalLocation"></p>
                </div>
                <div class="form-group">
                    <strong>Rémunération:</strong>
                    <p id="offerModalSalary"></p>
                </div>
                <div class="form-group">
                    <strong>Description:</strong>
                    <div id="offerModalDetails"></div>
                </div>
                <div class="modal-actions">
                    <button class="btn-primary">Postuler</button>
                    <button class="btn-secondary close">Fermer</button>
                </div>
            </div>
        </div>

        <div id="companyModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="companyModalTitle" class="modal-title"></h2>
                <div id="companyModalDetails">
                    <div class="form-group">
                        <strong>Description :</strong>
                        <p id="companyDescription"></p>
                    </div>
                    <div class="form-group">
                        <strong>Téléphone :</strong>
                        <p id="companyPhone"></p>
                    </div>
                    <div class="form-group">
                        <strong>Email :</strong>
                        <p id="companyEmail"></p>
                    </div>
                    <div class="form-group">
                        <strong>Adresse :</strong>
                        <p id="companyAddress"></p>
                    </div>
                </div>
                <!-- Section de notation -->
                <div class="rating-section">
                    <h3>Noter cette entreprise :</h3>
                    <div class="star-rating">
                        <i class="far fa-star" data-value="1"></i>
                        <i class="far fa-star" data-value="2"></i>
                        <i class="far fa-star" data-value="3"></i>
                        <i class="far fa-star" data-value="4"></i>
                        <i class="far fa-star" data-value="5"></i>
                    </div>
                    <p id="ratingValue">Note : 0/5</p>
                </div>
                <div class="modal-actions">
                    <button class="btn-secondary close">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
