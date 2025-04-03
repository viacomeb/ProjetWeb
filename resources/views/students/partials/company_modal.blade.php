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
    <div class="modal-actions">
        <button class="btn-secondary close" onclick="closeCompanyModal()">Fermer</button>
    </div>
</div>
