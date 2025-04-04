@extends('layout.app')

@section('title', ucfirst($page))

@section('content')
    <div class="container">
        <section class="about-section">
            <h1>Qui sommes-nous</h1>
            <div class="about-section-paragraphs">
                <p>
                    Bienvenue sur notre plateforme de recherche de stage. Nous sommes une équipe dévouée à aider les
                    étudiants à trouver le stage qui leur convient. Notre objectif est de simplifier leur recherche en
                    leur proposant des opportunités adaptées à leurs aspirations et compétences.
                </p>
                <p>
                    Nous croyons fermement en l'importance de soutenir les étudiants dans leur parcours professionnel et
                    de leur offrir les outils nécessaires pour réussir. Merci de nous faire confiance et de nous
                    permettre de contribuer à votre réussite.
                </p>
            </div>
            <div>
                <ul class="key-values">
                    <li>Simplifier la recherche de stage</li>
                    <li>Offrir des opportunités adaptées</li>
                    <li>Soutenir les étudiants dans leur parcours</li>
                    <li>Fournir des outils pour réussir</li>
                </ul>
            </div>
        </section>
    </div>
@endsection
