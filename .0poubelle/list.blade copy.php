@extends('layout.app')

@section('title', ucfirst($page))

@section('content')
    <div class="container">
        <section class="about-section">
            <h1>Liste des Entreprises</h1>
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>Entreprise</th>
                            <th>Description</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Ville</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    <div class="company-info">
                                        <span>{{ $company->company_name }}</span>
                                    </div>
                                </td>
                                <td>{{ Str::limit($company->description, 30) }}</td>
                                <!-- Limiter la description à 50 caractères -->
                                <td>{{ preg_replace('/\s+/', '', $company->phone) }}</td>
                                <!-- Supprimer les espaces dans le numéro de téléphone -->
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->city->city_name }}</td>
                                <td>
                                    <!-- Lien vers la page de détails de l'entreprise -->
                                    <a href="{{ route('companies.show', ['id' => $company->company_id]) }}"
                                        class="btn btn-outline">Voir</a>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $companies->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
@endsection
