<div class="modal-content">
    <h2>Postuler à l'offre</h2>
    <div>
        <label>Date et heure d'envoi :</label>
        <p>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>
    <form id="applyForm_{{ $offer->offer_id }}" method="POST" enctype="multipart/form-data"
        action="{{ route('apply.submit', ['offerId' => $offer->offer_id]) }}">
        @csrf
        <input type="hidden" name="_method" value="POST">
        <div class="form-group">
            <label for="lettre_de_motivation">Lettre de motivation</label>
            <input type="file" id="lettre_de_motivation" name="lettre_de_motivation" required>
        </div>
        <button type="submit" class="btn-primary">Envoyer</button>

        <div class="modal-actions">
            <button type="button" class="btn-secondary close" onclick="closeApplyModal()">Fermer</button>
        </div>
    </form>
</div>
