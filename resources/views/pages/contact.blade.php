@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')
    <div class="container">
        <section class="contact-section">
            <h1>Contactez-nous</h1>
            <p class="contact-description">
                Vous avez des questions ou souhaitez en savoir plus ? Utilisez nos
                coordonnées pour nous joindre. Nous serons ravis de vous aider !
            </p>
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Nos coordonnées</h2>
                    <p><strong>Email :</strong> contact@projetweb.com</p>
                    <p><strong>Téléphone :</strong> +33 1 23 45 67 89</p>
                    <p><strong>Adresse :</strong> 123 Rue de l'Innovation, Paris, France</p>
                </div>
            </div>
        </section>
    </div>
@endsection
