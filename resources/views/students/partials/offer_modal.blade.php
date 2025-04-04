<div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>{{ $offer->title ?? 'Titre non disponible' }}</h2>
    <div class="form-group">
        <strong>Entreprise:</strong>
        <p>{{ $offer->company->company_name ?? 'Entreprise non spécifiée' }}</p>
    </div>
    <div class="form-group">
        <strong>Localisation:</strong>
        <p>{{ $offer->company->city->city_name ?? 'Localisation non spécifiée' }}</p>
    </div>
    <div class="form-group">
        <strong>Rémunération:</strong>
        <p>{{ $offer->salary ?? 'Rémunération non spécifiée' }}</p>
    </div>
    <div class="form-group">
        <strong>Description:</strong>
        <div> {{$offer->description ?? 'Description non disponible' }}</div>
    </div>
    <div class="modal-actions">
        <button class="btn-primary">Postuler</button>
        <button class="btn-secondary close" onclick="closeModal()">Fermer</button>
    </div>
</div>
