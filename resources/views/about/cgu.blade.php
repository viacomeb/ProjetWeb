@extends('layout.app')

@section('title', ucfirst($page))

@section('content')

    <div class="container">
        <section class="about-section">
            <h1>Conditions Générales d'Utilisation (CGU)</h1>
            <div class="about-section-paragraphs">
                <p>
                    Bienvenue sur notre plateforme de recherche de stage. En utilisant notre site, vous acceptez nos
                    conditions générales d'utilisation. Veuillez les lire attentivement.
                </p>
                <br />
                <div>
                    <h2>1. Acceptation des CGU</h2>
                    <p>
                        En accédant à notre site, vous acceptez de respecter ces CGU. Si vous n'acceptez pas ces conditions,
                        veuillez ne pas utiliser notre site.
                    </p>
                    <br />
                    <h2>2. Modifications des CGU</h2>
                    <p>
                        Nous nous réservons le droit de modifier ces CGU à tout moment. Les modifications seront publiées
                        sur
                        cette page et entreront en vigueur dès leur publication.
                    </p>
                    <br />
                    <h2>3. Propriété intellectuelle</h2>
                    <p>
                        Tous les contenus présents sur notre site, y compris les textes, images et logos, sont protégés par
                        des droits d'auteur et ne peuvent être reproduits sans autorisation préalable.
                    </p>
                </div>
        </section>
    </div>
@endsection
