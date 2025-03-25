@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')
    <br />
    <br />
    <br />
    <br />
    <div class="container">
        <h1>Liste des Entreprises</h1>

        <!-- Vérifier si des entreprises existent -->
        @if ($entreprises->isEmpty())
            <div class="alert alert-warning">
                Aucune entreprise trouvée.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom de l'entreprise</th>
                        <th>Description</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Candidatures</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entreprises as $entreprise)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Affiche le numéro d'ordre de l'entreprise -->
                            <td>{{ $entreprise->nom }}</td>
                            <td>{{ Str::limit($entreprise->description, 50) }}
                                <!-- Limite la description à 50 caractères -->
                            </td>
                            <td>{{ $entreprise->telephone }}</td>
                            <td>{{ $entreprise->email }}</td>
                            <td>{{ $entreprise->candidatures }}</td>
                            <td>
                                <!-- Lien vers la page de détails de l'entreprise -->
                                <a href="{{ route('entreprises.show', ['id' => $entreprise->Id_Entreprise]) }}"
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
