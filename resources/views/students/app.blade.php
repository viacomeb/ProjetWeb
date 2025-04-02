<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WorknGo - @yield('title')</title>
    <link rel="icon" href="{{ asset('images/WorknGo_logo.png') }}">
    @vite('resources/css/student_dashboard.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js/dist/Chart.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>student Panel</span>
            </div>
            <ul class="nav-links">
                <li class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('student.dashboard') }}"><i class="fas fa-home"></i> Vue d'ensemble</a>
                </li>
                <li class="{{ request()->routeIs('students.internships') ? 'active' : '' }}">
                    <a href="{{ route('student.internships') }}"><i class="fas fa-briefcase"></i> Offres de stage</a>
                </li>
                <li class="{{ request()->routeIs('students.wishlist') ? 'active' : '' }}">
                    <a href="{{ route('student.wishlist') }}"><i class="fas fa-bookmark"></i> Wishlist</a>
                </li>
                <li class="{{ request()->routeIs('students.challenges') ? 'active' : '' }}">
                    <a href="{{ route('student.challenges') }}"><i class="fas fa-trophy"></i> Challenges</a>
                </li>
                <li class="{{ request()->routeIs('students.community') ? 'active' : '' }}">
                    <a href="{{ route('student.community') }}"><i class="fas fa-users"></i> Communauté</a>
                </li>
                <li class="{{ request()->routeIs('students.messages') ? 'active' : '' }}">
                    <a href="{{ route('student.messages') }}"><i class="fas fa-envelope"></i> Messagerie</a>
                </li>
                <li class="{{ request()->routeIs('students.settings') ? 'active' : '' }}">
                    <a href="{{ route('student.settings') }}"><i class="fas fa-user"></i> Mon Profil</a>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher une offre..." />
                </div>
                <div class="user-menu">
                    <div class="xp-counter">
                        <i class="fas fa-star"></i>
                        <span>1250 XP</span>
                    </div>
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="profile">
                        <img src="https://ui-avatars.com/api/?name={{ $student->name ?? 'Invité' }}" alt="Profile" />
                        <span>{{ $student->name ?? 'Invité' }}</span>
                        <div class="level-badge">Niveau {{ $student->level ?? 'N/A' }}</div>
                    </div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
    @vite('resources/js/student_dashboard.js')
</body>

</html>
