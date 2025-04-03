@extends('students.app')

@section('title', 'Wishlist')

@section('content')
<div class="dashboard-content">
    <section id="wishlist" class="section-content active">
        <div class="section-header">
            <h1>Ma Wishlist</h1>
        </div>
        <div class="offers-grid" id="wishlistGrid">
            @forelse ($wishlist as $item)
            <div class="offer-card" data-id="{{ $item->offer->offer_id }}">
                <div class="offer-header">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->offer->company->company_name ?? 'Non spécifié') }}"
                        alt="Company Logo" class="company-logo" />
                    <div class="offer-info">
                        <h3>{{ $item->offer->title }}</h3>
                        <div class="company-box" data-id="{{ $item->offer->company->company_id }}"
                            onclick="openCompanyModal(event, {{ $item->offer->company->company_id }})">
                            <p>{{ $item->offer->company->company_name ?? 'Non spécifié' }}</p>
                        </div>
                    </div>
                </div>
                <div class="offer-details">
                    <p class="offer-location"><i class="fas fa-map-marker-alt"></i>
                        {{ $item->offer->company->city->city_name ?? 'Non spécifié' }}
                    </p>
                    <p class="offer-salary"><i class="fas fa-euro-sign"></i> {{ $item->offer->salary ?? 'Non spécifié' }}
                    </p>
                </div>
                <div class="offer-actions">
                    <button class="btn-primary"
                        onclick="event.stopPropagation(); openApplyModal({{ $item->offer->offer_id }})"><i
                            class="fas fa-paper-plane"></i> Postuler</button>
                    <button class="btn-secondary" onclick="event.stopPropagation(); toggleWishlist({{ $item->offer->offer_id }}, this)">
                        <i class="fas fa-bookmark"></i> Retirer des favoris
                    </button>
                </div>
            </div>
            @empty
            <p>Aucune offre dans votre wishlist.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    .empty-state {
        text-align: center;
        padding: 40px;
        background-color: var(--color-surface);
        border-radius: var(--border-radius);
        margin: 20px 0;
    }

    .empty-state i {
        font-size: 48px;
        color: var(--color-text-secondary);
        margin-bottom: 20px;
    }

    .offers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .offer-card {
        background-color: var(--color-surface);
        border-radius: var(--border-radius);
        padding: 20px;
        box-shadow: var(--shadow);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .offer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .offer-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .company-logo {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
    }

    .offer-info h3 {
        margin: 0;
        color: var(--color-text);
        font-size: 1.1rem;
    }

    .company-box {
        color: var(--color-text-secondary);
        cursor: pointer;
    }

    .company-box:hover {
        color: var(--primary-color);
    }

    .offer-details {
        margin-bottom: 20px;
    }

    .offer-location,
    .offer-salary {
        color: var(--color-text-secondary);
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .offer-actions {
        display: flex;
        gap: 10px;
    }

    .btn-primary,
    .btn-secondary {
        padding: 8px 15px;
        border-radius: var(--border-radius);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
    }

    .btn-secondary {
        background-color: var(--color-surface);
        color: var(--color-text-secondary);
    }

    .btn-secondary:hover {
        background-color: var(--gray-light);
    }
</style>
@endpush

@push('scripts')
<script>
    function openOfferModal(offerId) {
        closeAllModals();
        const modal = document.getElementById('offerModal');
        const modalContent = document.getElementById('offerModalContent');

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
                showNotification('Une erreur est survenue lors du chargement des détails de l\'offre.', 'error');
            });
    }

    function openCompanyModal(event, companyId) {
        event.stopPropagation();
        closeAllModals();
        const modal = document.getElementById('companyModal');
        const modalContent = document.getElementById('companyModalContent');

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
                showNotification('Une erreur est survenue lors du chargement des détails de l\'entreprise.', 'error');
            });
    }

    function openApplyModal(offerId) {
        closeAllModals();
        const modal = document.getElementById('applyModal');
        const modalContent = document.getElementById('applyModalContent');

        fetch(`/student/offers/${offerId}/apply`)
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
                showNotification('Une erreur est survenue lors du chargement du formulaire de candidature.', 'error');
            });
    }

    function closeAllModals() {
        const modals = document.querySelectorAll('.modal.active');
        modals.forEach(modal => {
            modal.classList.remove('active');
            modal.querySelector('.modal-content').innerHTML = '';
        });
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
                if (data.action === 'removed') {
                    button.closest('.offer-card').remove();
                    showNotification('Offre retirée des favoris');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification(error.message || 'Une erreur est survenue', 'error');
            });
    }

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
            closeAllModals();
        }
    });
</script>
@endpush
