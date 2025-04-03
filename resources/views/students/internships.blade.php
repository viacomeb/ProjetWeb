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
            <div class="offer-card" data-id="{{ $offer->offer_id }}"
                onclick="openOfferModal({{ $offer->offer_id }})">
                <div class="offer-header">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($offer->company->company_name ?? 'Non spécifié') }}"
                        alt="Company Logo" class="company-logo" />
                    <div class="offer-info">
                        <h3>{{ $offer->title }}</h3>
                        <div class="company-box" data-id="{{ $offer->company->company_id }}"
                            onclick="openCompanyModal(event, {{ $offer->company->company_id }})">
                            <p>{{ $offer->company->company_name ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>
                <div class="offer-details">
                    <p class="offer-location"><i class="fas fa-map-marker-alt"></i>
                        {{ $offer->company->city->city_name ?? 'Non spécifié' }}
                    </p>
                    <p class="offer-salary"><i class="fas fa-euro-sign"></i> {{ $offer->salary ?? 'Non spécifié' }}
                    </p>
                </div>
                <div class="offer-actions">
                    <button class="btn-primary"
                        onclick="event.stopPropagation(); openApplyModal({{ $offer->offer_id }})"><i
                            class="fas fa-paper-plane"></i> Postuler</button>
                    <button class="btn-secondary" onclick="event.stopPropagation(); toggleWishlist({{ $offer->offer_id }}, this)">
                        <i class="fas fa-bookmark"></i> Ajouter aux favoris
                    </button>
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

    <!-- Modal for Apply -->
    <div id="applyModal" class="modal">
        <div id="applyModalContent"></div>
    </div>
</div>

<script>
    // Add logic to close other modals when opening a new one
    function closeAllModals() {
        const modals = document.querySelectorAll('.modal.active');
        modals.forEach(modal => {
            modal.classList.remove('active');
            modal.querySelector('.modal-content').innerHTML = '';
        });
    }

    function openOfferModal(offerId) {
        closeAllModals(); // Close other modals
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
        closeAllModals(); // Close other modals
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

    function openApplyModal(offerId) {
        closeAllModals(); // Close other modals
        const modal = document.getElementById('applyModal');
        const modalContent = document.getElementById('applyModalContent');

        // Fetch the modal content from the server via the controller
        fetch(`/apply/${offerId}`)
            .then(response => {
                if (!response.ok) {
                    if (response.status === 404) {
                        throw new Error('Offre non trouvée.');
                    } else {
                        throw new Error('Une erreur est survenue lors du chargement du formulaire de candidature.');
                    }
                }
                return response.text(); // Expect HTML response
            })
            .then(html => {
                modalContent.innerHTML = html;
                modal.classList.add('active');
            })
            .catch(error => {
                console.error('Error loading modal content:', error);
                alert(error.message);
            });
    }

    function closeApplyModal() {
        const modal = document.getElementById('applyModal');
        modal.classList.remove('active');
        document.getElementById('applyModalContent').innerHTML = '';
    }

    function toggleWishlist(offerId, button) {
        fetch(`/student/wishlist/toggle/${offerId}`, {
                method: 'POST',
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
                if (data.action === 'added') {
                    button.style.backgroundColor = 'gold';
                    button.innerHTML = '<i class="fas fa-bookmark"></i> Retirer des favoris';
                    showNotification('Offre ajoutée aux favoris');
                } else if (data.action === 'removed') {
                    button.style.backgroundColor = '';
                    button.innerHTML = '<i class="fas fa-bookmark"></i> Ajouter aux favoris';
                    showNotification('Offre retirée des favoris');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification(error.message || 'Une erreur est survenue', 'error');
            });
    }

    function showNotification(message, type = 'success') {
        // Créer l'élément de notification
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;

        // Ajouter la notification au document
        document.body.appendChild(notification);

        // Supprimer la notification après 3 secondes
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>
@endsection
