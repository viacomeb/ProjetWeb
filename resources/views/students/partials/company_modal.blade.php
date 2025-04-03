<div class="modal-content">
    <span class="close" onclick="closeCompanyModal()">&times;</span>
    <h2>{{ $company->company_name ?? 'Nom non disponible' }}</h2>
    <div class="form-group">
        <strong>Description:</strong>
        <p>{{ $company->description ?? 'Description non disponible' }}</p>
    </div>
    <div class="form-group">
        <strong>Téléphone:</strong>
        <p>{{ $company->phone ?? 'Téléphone non disponible' }}</p>
    </div>
    <div class="form-group">
        <strong>Email:</strong>
        <p>{{ $company->email ?? 'Email non disponible' }}</p>
    </div>
    <div class="form-group">
        <strong>Adresse:</strong>
        <p>{{ $company->street ?? '' }} {{ $company->street_number ?? '' }}, {{ $company->city->city_name ?? 'Ville non disponible' }}</p>
    </div>
    <div class="form-group">
        <strong>Note moyenne:</strong>
        <p id="averageRating">{{ $averageRating ? number_format($averageRating, 1) : 'Pas encore notée' }}</p>
    </div>
    <div class="rating-section">
        <h3>Noter cette entreprise :</h3>
        <div class="star-rating" id="starRating" data-company-id="{{ $company->company_id }}" data-user-id="{{ auth()->id() }}">
            <i class="far fa-star" data-value="1"></i>
            <i class="far fa-star" data-value="2"></i>
            <i class="far fa-star" data-value="3"></i>
            <i class="far fa-star" data-value="4"></i>
            <i class="far fa-star" data-value="5"></i>
        </div>
        <p id="ratingValue">Note : 0/5</p>
    </div>
    <div class="modal-actions">
        <button class="btn-secondary close" onclick="closeCompanyModal()">Fermer</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starRating = document.getElementById('starRating');

        if (starRating) {
            starRating.addEventListener('click', function(event) {
                const star = event.target.closest('i'); // Get the clicked star
                if (!star) return;

                const rating = parseInt(star.getAttribute('data-value'), 10); // Get the star value
                const companyId = starRating.getAttribute('data-company-id'); // Get the company ID
                const userId = starRating.getAttribute('data-user-id'); // Get the user ID

                if (!companyId || !userId) {
                    console.error('Company ID or User ID is missing.');
                    return;
                }

                // Highlight the stars up to the clicked one
                const stars = starRating.querySelectorAll('i');
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.remove('far'); // Remove the "far" class for empty stars
                        s.classList.add('fas', 'yellow'); // Add "fas" and "yellow" for filled stars
                    } else {
                        s.classList.remove('fas', 'yellow'); // Remove "fas" and "yellow" for unselected stars
                        s.classList.add('far'); // Add the "far" class for empty stars
                    }
                });

                // Update the rating value display
                const ratingValue = document.getElementById('ratingValue');
                ratingValue.textContent = `Note : ${rating}/5`;

                // Send the rating to the backend
                fetch(`/companies/${companyId}/rate`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: `user_id=${userId}&rating=${rating}`,
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to submit rating');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data.message); // Log the backend response
                        const averageRatingElement = document.getElementById('averageRating');
                        if (data.averageRating) {
                            averageRatingElement.textContent = data.averageRating; // Update the average rating
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting rating:', error);
                        alert('Une erreur est survenue lors de la soumission de la note.');
                    });
            });
        }
    });
</script>
