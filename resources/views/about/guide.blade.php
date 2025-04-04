@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')

    <div class="container">
        <section class="about-section">
            <h1>Guide</h1>
            <div class="about-section-paragraphs">
                <p class="about-section-description">
                    Bienvenue dans notre guide ! Ici, vous trouverez toutes les
                    informations nécessaires pour bien utiliser notre plateforme.
                </p>
                <p class="about-section-description">
                    Notre guide est conçu pour vous aider à naviguer facilement
                    à travers nos fonctionnalités et à tirer le meilleur parti de
                    notre service.
                </p>
                <p class="about-section-description">
                    Si vous avez des questions ou avez besoin d'aide, n'hésitez
                    pas à nous contacter via notre page de support.
                </p>
                <p class="about-section-description">
                    Nous sommes là pour vous aider à chaque étape de votre
                    expérience avec nous.
                </p>
                <p class="about-section-description">
                    Merci de faire partie de notre communauté et de nous
                    choisir pour vos besoins professionnels.
                </p>
                <p class="about-section-description">
                    Nous espérons que ce guide vous sera utile et que vous
                    apprécierez votre expérience avec nous.
                </p>
                <p class="about-section-description">
                    N'hésitez pas à explorer toutes nos fonctionnalités et à
                    profiter de tout ce que nous avons à offrir.
                </p>
                <p class="about-section-description">
                    Si vous avez des suggestions ou des commentaires sur notre
                    guide, nous serions ravis de les entendre. Votre avis est
                    précieux pour nous et nous aide à améliorer nos services.
                </p>
                <p class="about-section-description">
                    Merci encore de votre confiance et de votre soutien. Nous
                    sommes impatients de vous accompagner dans votre parcours
                    professionnel.
                </p>
                <p class="about-section-description">
                    Bonne lecture et bonne découverte de notre guide !
                </p>
                <br />
                <p class="about-section-description" style="text-align: center;">
                    <strong>EN CONSTRUCTION</strong>
                </p>
            </div>
        </section>
    </div>
@endsection
