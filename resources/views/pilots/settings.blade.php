@extends('pilots.app')

@section('title', ucfirst($page))

@section('content')
<!-- Dashboard Content -->
<div class="dashboard-content">
    <section id="settings" class="section-content active">
        <h1>Paramètres</h1>
        <div class="settings-grid">
            <div class="settings-card">
                <h3>Gestion des rôles</h3>
                <div class="roles-list">
                    <div class="role-item">
                        <div class="role-header">
                            <h4>Étudiants</h4>
                            <span class="user-count">523 utilisateurs</span>
                        </div>
                        <div class="permissions">
                            <label class="permission">
                                <input type="checkbox" checked />
                                <span>Postuler aux offres</span>
                            </label>
                            <label class="permission">
                                <input type="checkbox" checked />
                                <span>Messagerie</span>
                            </label>
                            <label class="permission">
                                <input type="checkbox" />
                                <span>Forum</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="settings-card">
                <h3>Sécurité</h3>
                <div class="security-settings">
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Double authentification</h4>
                            <p>Exiger la 2FA pour les comptes administrateurs</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked />
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Journalisation</h4>
                            <p>Activer la journalisation détaillée</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked />
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Politique de mot de passe</h4>
                            <p>Exiger des mots de passe forts</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked />
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="settings-card">
                <h3>RGPD</h3>
                <div class="gdpr-settings">
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Conservation des données</h4>
                            <p>Durée de conservation : 24 mois</p>
                        </div>
                        <button class="btn-secondary">Configurer</button>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Exports de données</h4>
                            <p>Dernière exportation : 12/03/2024</p>
                        </div>
                        <button class="btn-secondary">Exporter</button>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <h4>Demandes de suppression</h4>
                            <p>2 demandes en attente</p>
                        </div>
                        <button class="btn-secondary">Gérer</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</main>
</div>
@endsection
