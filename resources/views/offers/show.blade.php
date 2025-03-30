@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')
    <div class="offer-details">
        <h1>{{ $offer->title }}</h1>
        <p><strong>Description :</strong></p>
        <p>{{ $offer->description }}</p>
        <p><strong>Salaire :</strong> {{ $offer->salary }} €</p>
        <p><strong>Date de début :</strong> {{ $offer->start_date }}</p>
        <p><strong>Date de fin :</strong> {{ $offer->end_date }}</p>
        <p><strong>Statut :</strong> {{ $offer->is_active ? 'Active' : 'Inactive' }}</p>
        <p><strong>Nombre de vues :</strong> {{ $offer->view_count }}</p>
        <p><strong>Entreprise :</strong> {{ $offer->company->company_name }}</p>
    </div>
@endsection
