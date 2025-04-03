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
            @foreach ($offers as $offer)
            <div class="offer-card" data-id="{{ $offer->offer_id }}" onclick="openOfferModal({{ $offer->offer_id }})">
                <div class="offer-header">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($offer->company->company_name ?? 'Non spécifié') }}" alt="Company Logo" class="company-logo" />
                    <div class="offer-info">
                        <h3>{{ $offer->title }}</h3>
                        <div class="company-box" data-id="{{ $offer->company->company_id }}" onclick="openCompanyModal(event, {{ $offer->company->company_id }})">
                            <p>{{ $offer->company->company_name ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>
                <div class="offer-details">
                    <p class="offer-location"><i class="fas fa-map-marker-alt"></i> {{ $offer->company->city->city_name ?? 'Non spécifié' }}</p>
                    <p class="offer-salary"><i class="fas fa-euro-sign"></i> {{ $offer->salary ?? 'Non spécifié' }}</p>
                </div>
                <div class="offer-actions">
                    <button class="btn-primary"><i class="fas fa-paper-plane"></i> Postuler</button>
                    <button class="btn-secondary"><i class="fas fa-bookmark"></i> Ajouter aux favoris</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination" id="pagination">
            <!-- Render pagination links -->
            {{ $offers->links('pagination::bootstrap-4') }}
        </div>
    </section>

    <!-- Modal Container -->
    <div id="offerModal" class="modal">
        <div id="offerModalContent"></div>
    </div>

    <div id="companyModal" class="modal">
        <div id="companyModalContent"></div>
    </div>
</div>

<script>
    function openOfferModal(offerId) {
        const modal = document.getElementById('offerModal');
        const modalContent = document.getElementById('offerModalContent');

        // Fetch the modal content from the server
        fetch(`/offers/modal/${offerId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load modal content');
                }
                return response.text();
            })
            .then(html => {
                modalContent.innerHTML = html;
                modal.classList.add('active');
            })
            .catch(error => {
                console.error('Error loading modal content:', error);
                alert('Une erreur est survenue lors du chargement des détails de l\'offre.');
            });
    }

    function closeModal() {
        const modal = document.getElementById('offerModal');
        modal.classList.remove('active');
        document.getElementById('offerModalContent').innerHTML = '';
    }

    function openCompanyModal(event, companyId) {
        event.stopPropagation(); // Prevent the click event from propagating to the parent
        const modal = document.getElementById('companyModal');
        const modalContent = document.getElementById('companyModalContent');

        // Fetch the modal content from the server
        fetch(`/companies/modal/${companyId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load modal content');
                }
                return response.text();
            })
            .then(html => {
                modalContent.innerHTML = html;
                modal.classList.add('active');
            })
            .catch(error => {
                console.error('Error loading modal content:', error);
                alert('Une erreur est survenue lors du chargement des détails de l\'entreprise.');
            });
    }

    function closeCompanyModal() {
        const modal = document.getElementById('companyModal');
        modal.classList.remove('active');
        document.getElementById('companyModalContent').innerHTML = '';
    }
</script>
@endsection
