@extends('pilots.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="applications" class="section-content active">
            <div class="section-header">
                <h1>Suivi des Candidatures</h1>
            </div>
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Entreprise</th>
                            <th>Poste</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->student->user->first_name }}
                                    {{ $application->student->user->last_name }}</td>
                                <td>{{ $application->offer->company->company_name }}</td>
                                <td>{{ $application->offer->title }}</td>
                                <td>
                                    <div class="actions">
                                        <button class="btn-icon" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $applications->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
@endsection
