@extends('layout.app')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')
    <div class="container">
        <section class="about-section">
            <h1>Politique de confidentialité</h1>
            <div class="about-section-paragraphs">
                <p>
                    Nous nous engageons à protéger votre vie privée. Cette politique explique comment nous collectons,
                    utilisons et protégeons vos informations personnelles.
                </p>
                <br />
                <div class="privacy-grid">
                    <div class="privacy-info">
                        <h2>Collecte d'informations</h2>
                        <p>
                            Nous collectons des informations lorsque vous vous inscrivez sur notre site, remplissez un
                            formulaire ou interagissez avec nos services. Les informations collectées peuvent inclure votre
                            nom, adresse e-mail, numéro de téléphone et autres données pertinentes.
                        </p>
                    </div>
                    <br />
                    <div class="privacy-info">
                        <h2>Utilisation des informations</h2>
                        <p>
                            Les informations que nous collectons peuvent être utilisées pour :
                        </p>
                        <ul>
                            <p>Améliorer notre site Web</p>
                            <p>Améliorer le service client</p>
                            <p>Traiter les transactions</p>
                            <p>Envoyer des e-mails périodiques</p>
                        </ul>
                    </div>
                    <br />
                    <div class="privacy-info">
                        <h2>Protection des informations</h2>
                        <p>
                            Nous mettons en œuvre une variété de mesures de sécurité pour protéger vos informations
                            personnelles. Cependant, aucune méthode de transmission sur Internet ou méthode de stockage
                            électronique n'est sécurisée à 100 %.
                        </p>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
