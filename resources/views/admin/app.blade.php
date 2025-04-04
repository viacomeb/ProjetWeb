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
                <img src="{{ asset('images/WorknGo_logo.png') }}" alt="WorknGo Logo" class="logo-img" style="width: 45px; height: auto;">
                <span>Admin Panel</span>
            </div>
            <ul class="nav-links">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Vue d'ensemble</a>
                </li>
                <li class="{{ request()->routeIs('admin.companies') ? 'active' : '' }}">
                    <a href="{{ route('admin.companies') }}"><i class="fas fa-building"></i> Entreprises</a>
                </li>
                <li class="{{ request()->routeIs('admin.internships') ? 'active' : '' }}">
                    <a href="{{ route('admin.internships') }}"><i class="fas fa-briefcase"></i> Offres de stage</a>
                </li>
                <li class="{{ request()->routeIs('admin.pilots') ? 'active' : '' }}">
                    <a href="{{ route('admin.pilots') }}"><i class="fas fa-user-tie"></i> Pilotes</a>
                </li>
                <li class="{{ request()->routeIs('admin.students') ? 'active' : '' }}">
                    <a href="{{ route('admin.students') }}"><i class="fas fa-user-graduate"></i> Étudiants</a>
                </li>
                <li class="{{ request()->routeIs('admin.applications') ? 'active' : '' }}">
                    <a href="{{ route('admin.applications') }}"><i class="fas fa-file-alt"></i> Candidatures</a>
                </li>
                <li class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i> Paramètres</a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST"
                    style="display: none; text-decoration: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                    class="logout-btn">
                    Déconnexion
                </a>
            </div>
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
                    <div class="profile">
                        <img src="https://ui-avatars.com/api/?name=Admin" alt="Profile" />
                        <span>Administrateur</span>
                    </div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
    @vite('resources/js/admin_dashboard.js')
    @stack('scripts')
</body>

</html>
