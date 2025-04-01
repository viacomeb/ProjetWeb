@extends('admin.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="overview" class="section-content active">
            <h1>Vue d'ensemble</h1>
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-details">
                        <h3>156</h3>
                        <p>Entreprises enregistrées</p>
                    </div>
                </div>
                <div class="stat-</div>card">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stat-details">
                        <h3>284</h3>
                        <p>Offres actives</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-details">
                        <h3>523</h3>
                        <p>Étudiants inscrits</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-details">
                        <h3>78%</h3>
                        <p>Stages pourvus</p>
                    </div>
                </div>
            </div>
            <div class="charts-container">
                <div class="chart-card">
                    <h3>Top 5 entreprises</h3>
                    <canvas id="topCompaniesChart"></canvas>
                </div>
            </div>
            <div class="chart-card">
                <h3>Répartition par domaine</h3>
                <canvas id="domainChart"></canvas>
            </div>
    </div>
    <div class="recent-activities">
        <h2>Activités récentes</h2>
        <div class="activity-list">
            <div class="activity-item">
                <i class="fas fa-plus-circle"></i>
                <div class="activity-details">
                    <p>
                        Nouvelle entreprise ajoutée : <strong>TechCorp</strong>
                    </p>
                </div>
            </div>
            <div class="activity-item">
                <i class="fas fa-user-plus"></i>
                <div class="activity-details">
                    <p>Nouveau pilote créé : <strong>Jean Martin</strong></p>
                </div>
            </div>
        </div>
    </div>
    </section>
    </div>
    </main>
    </div>
@endsection
