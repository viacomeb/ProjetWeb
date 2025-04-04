@extends('students.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <!-- Profile Section -->
        <section id="profile" class="section-content active">
            <div class="section-header">
                <h1>Mon Profil</h1>
            </div>
            <div class="profile-container">
                <!-- Affichage des informations de base -->
                <div class="profile-info" id="profileInfo">
                    <h2>Informations de base</h2>
                    <p>
                        <strong>Nom :</strong>
                        <span id="profileName">Doe</span>
                    </p>
                    <p>
                        <strong>Nom :</strong>
                        <span id="profileFirstName">John</span>
                    </p>
                    <p>
                        <strong>Email :</strong>
                        <span id="profileEmail">john.doe@example.com</span>
                    </p>
                    <p>
                        <strong>Téléphone :</strong>
                        <span id="profilePhone">+33 6 12 34 56 78</span>
                    </p>

                    <!-- Affichage des fichiers -->
                    <h2>Fichiers</h2>
                    <p>
                        <strong>CV :</strong>
                        <span id="cvFileName">Non renseigné</span>
                    </p>
                    <p>
                        <strong>Lettre de motivation :</strong>
                        <span id="coverLetterFileName">Non renseigné</span>
                    </p>
                    <!-- Bouton pour modifier les informations -->
                    <button id="editProfile" class="btn-secondary">
                        Modifier les informations
                    </button>
                </div>

                <!-- Formulaire de modification (caché par défaut) -->
                <form id="profileForm" class="profile-form hidden" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Name">Nom</label>
                        <input type="text" id="Name" name="Name" placeholder="Votre nom complet" required />
                    </div>
                    <div class="form-group">
                        <label for="firstName">Prenom</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Votre nom complet" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" placeholder="Votre adresse email" required />
                    </div>
                    <div class="form-group">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="cvFile">CV</label>
                        <input type="file" id="cvFile" name="cvFile" />
                    </div>
                    <div class="form-group">
                        <label for="coverLetterFile">Lettre de motivation</label>
                        <input type="file" id="coverLetterFile" name="coverLetterFile" />
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Enregistrer</button>
                        <button type="button" class="btn-secondary" id="cancelEdit">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
