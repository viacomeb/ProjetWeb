@extends('layout.app')

@section('title', ucfirst($page))

@section('content')
    <div class="container">
        <h1>Liste des Offres</h1>

        <!-- Vérifier si des offres existent -->
        @if ($offers->isEmpty())
            <div class="alert alert-warning">
                Aucune offre trouvée.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre de l'offre</th>
                        <th>Description</th>
                        <th>Salaire</th>
                        <th>Entreprise</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Affiche le numéro d'ordre de l'offre -->
                            <td>{{ $offer->title }}</td>
                            <td>{{ Str::limit($offer->description, 50) }}
                                <!-- Limite la description à 50 caractères -->
                            </td>
                            <td>{{ $offer->salary }}</td>
                            <td>{{ $offer->company->company_name }}</td>
                            <td>
                                <!-- Lien vers la page de détails de l'offre -->
                                <a href="{{ route('offers.show', ['id' => $offer->offer_id]) }}"
                                    class="btn btn-outline">Voir</a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
