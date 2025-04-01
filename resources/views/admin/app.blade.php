<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WorknGo - @yield('title')</title>
    <link rel="icon" href="{{ asset('images/WorknGo_logo.png') }}">
    @vite('resources/css/admin_dashboard.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js/dist/Chart.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>Admin Panel</span>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Vue d'ensemble</a>
                </li>
                <li>
                    <a href="{{ route('admin.companies') }}"><i class="fas fa-building"></i> Entreprises</a>
                </li>
                <li class="active">
                    <a href="{{ route('admin.internships') }}"><i class="fas fa-briefcase"></i> Offres de stage</a>
                </li>
                <li>
                    <a href="{{ route('admin.pilots') }}"><i class="fas fa-user-tie"></i> Pilotes</a>
                </li>
                <li>
                    <a href="{{ route('admin.students') }}"><i class="fas fa-user-graduate"></i> Étudiants</a>
                </li>
                <li>
                    <a href="{{ route('admin.applications') }}"><i class="fas fa-file-alt"></i> Candidatures</a>
                </li>
                <li>
                    <a href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i> Paramètres</a>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher..." />
                </div>
                <div class="user-menu">
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="badge">5</span>
                    </div>
                    <div class="profile">
                        <img src="https://ui-avatars.com/api/?name=Admin" alt="Profile" />
                        <span>Administrateur</span>
                    </div>
                </div>
            </header>

            @yield('content')

            @vite('resources/js/admin_dashboard.js')
</body>

</html>
