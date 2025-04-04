@extends('layout.app')

@section('title', ucfirst($page))

@section('content')
    <div class="container">
        <section class="about-section">
            <h1>Liste des Offres</h1>

            <!-- Vérifier si des offres existent -->
            @if ($offers->isEmpty())
                <div class="alert alert-warning">
                    Aucune offre trouvée.
                </div>
            @else
                <div class="data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Entreprise</th>
                                <th>Date de début</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr class="offer-row" data-offer-id="{{ $offer->offer_id }}" style="cursor: pointer;">
                                    <td>{{ $offer->title }}</td>
                                    <td>{{ $offer->company->company_name ?? 'Non spécifié' }}</td>
                                    <td>{{ $offer->start_date }}</td>
                                    <td>
                                        <!-- Lien vers la page de détails de l'entreprise -->
                                        <a href="{{ route('offers.show', ['id' => $offer->offer_id]) }}"
                                            class="btn btn-outline">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {{ $offers->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </section>
    </div>
@endsection
