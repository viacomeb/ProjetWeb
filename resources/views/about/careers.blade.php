@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')
    <div class="container">
        <section class="careers-section">
            <h1>Carrières</h1>
            <div class="careers-description">
                <p>
                    Rejoignez notre équipe dynamique et contribuez à façonner l'avenir des étudiants en leur offrant des
                    opportunités de stage adaptées. Nous recherchons des personnes passionnées, motivées et prêtes à faire
                    une différence.
                </p>
            </div>
            <div class="careers-list">
                <h2>Postes disponibles</h2>
                <ul>
                    <li>
                        <strong>Développeur Web</strong> - Créez des solutions innovantes pour notre plateforme.
                    </li>
                    <li>
                        <strong>Responsable Marketing</strong> - Développez des stratégies pour atteindre plus d'étudiants.
                    </li>
                    <li>
                        <strong>Chargé de Relations Entreprises</strong> - Collaborez avec des entreprises pour offrir des
                        stages de qualité.
                    </li>
                </ul>
            </div>
            <br>
            <btn class="btn btn-outline"><a href="{{ route('contact') }}">Rejoignez-nous !</a></btn>
        </section>
    </div>
@endsection
