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
                    <button class="btn-secondary" onclick="event.stopPropagation(); toggleWishlist({{ $offer->offer_id }}, this)"><i class="fas fa-bookmark"></i> Ajouter aux favoris</button>
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

    function toggleWishlist(offerId, button) {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');
        const studentId = document
            .querySelector('meta[name="student-id"]')
            ?.getAttribute('content');

        if (!csrfToken || !studentId) {
            console.error(
                'CSRF token or student ID not found. Ensure the meta tags are present in the HTML.'
            );
            return;
        }

        fetch(`/offers/${offerId}/wishlist/${studentId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((err) => {
                        console.error('Server error response:', err);
                        throw new Error(err.error || 'Failed to toggle wishlist');
                    });
                }
                return response.json();
            })
            .then((data) => {
                if (data.action === 'added') {
                    button.classList.add('active');
                    button.innerHTML =
                        '<i class="fas fa-bookmark"></i> Retirer des favoris';
                    alert('Offre ajoutée aux favoris.');
                } else if (data.action === 'removed') {
                    button.classList.remove('active');
                    button.innerHTML =
                        '<i class="fas fa-bookmark"></i> Ajouter aux favoris';
                    alert('Offre retirée des favoris.');
                }
            })
            .catch((error) => {
                console.error('Error toggling wishlist:', error);
                alert(`Une erreur est survenue : ${error.message}`);
            });
    }
</script>
@endsection
