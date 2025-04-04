@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')
    <div class="container">
        <section class="about-section">
            <div class="company-profile">
                <h1>{{ $company->company_name }}</h1>
                <p><strong>Adresse :</strong> {{ $company->street_number }} {{ $company->street }},
                    {{ $company->city->postal_code }} {{ $company->city->city_name }}
                </p>
                <p><strong>Email :</strong> {{ $company->email }}</p>
                <p><strong>Téléphone :</strong> {{ $company->phone }}</p>
                <p><strong>Description :</strong></p>
                <p>{{ $company->description }}</p>
            </div>
        </section>
    </div>
@endsection
