@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')

    <div class="container">
        <section class="about-section">
            <h1>Support</h1>
            <div class="about-section-paragraphs">
                <p class="about-section-paragraph">
                    Vous avez des questions ou besoin d'aide ? Notre équipe de support est là pour vous aider.
                    N'hésitez pas à nous contacter pour toute demande d'assistance ou de renseignement.
                </p>
                <p class="about-section-paragraph">
                    Nous nous engageons à vous fournir un service de qualité et à répondre à vos besoins dans les
                    meilleurs délais.
                    Notre équipe est disponible pour vous accompagner et vous guider dans l'utilisation de nos
                    services.
                    Que ce soit pour des questions techniques, des demandes de renseignements ou des suggestions
                    d'amélioration, nous sommes à votre écoute.
                </p>
            </div>
        </section>
    </div>
@endsection
