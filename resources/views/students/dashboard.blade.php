@extends('layout.noapp')

@section('title', ucfirst($page))

<?php
$userData = [
    'streak' => 3,
    'applications' => [
        'sent' => 5,
        'pending' => 2,
        'interviews' => 1,
    ],
    'level' => 2,
    'title' => 'Débutant',
    'xp' => [
        'current' => 150,
        'max' => 300,
    ],
];

$recommendedInternships = [
    ['title' => 'Développeur Web', 'company' => 'Tech Company', 'location' => 'Paris', 'match' => 85],
    ['title' => 'Designer UI/UX', 'company' => 'Creative Agency', 'location' => 'Lyon', 'match' => 90],
    // Add more internships as needed
];

$badges = [
    ['name' => 'Nouveau membre', 'icon' => 'star', 'color' => 'yellow'],
    ['name' => 'Posteur actif', 'icon' => 'briefcase', 'color' => 'blue'],
    // Add more badges as needed
];
?>

@section('content')

    <body class="min-h-screen bg-gray-900 text-white">
        <!-- Header -->
        <header class="bg-gray-800 border-b border-gray-700 p-4">
            <div class="container mx-auto flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('students.dashboard') }}" class="logo-link">
                    <div class="text-2xl font-bold gradient-text logo flex items-center">
                        <img src="{{ Vite::asset('resources/images/WorknGo_logo.svg') }}" alt="Logo"
                            class="logo-icon h-8 w-8 mr-2">
                        <span>WorknGo</span>
                    </div>
                </a>

                <!-- Barre de recherche -->
                <div class="flex-1 mx-8">
                    <div class="relative">
                        <i data-lucide="search"
                            class="search-icon absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Rechercher un stage..."
                            class="w-full bg-gray-700 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="searchInput">
                    </div>
                </div>

                <!-- Notifications et Profil -->
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 hover:bg-gray-700 rounded-lg">
                        <i data-lucide="bell"></i>
                        <span class="notification-dot absolute top-1 right-1 bg-red-500 w-2 h-2 rounded-full"></span>
                    </button>
                    <button class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg">
                        <i data-lucide="user"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto py-8 px-4">
            <!-- Progress Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Progression Card -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold">Progression</h2>
                        <i data-lucide="flame" class="text-orange-500"></i>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span>Streak actif</span>
                                <span class="text-orange-500">{{ $userData['streak'] }} jours 🔥</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ ($userData['streak'] / 7) * 100 }}%"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="stat-card">
                                <div class="text-xl font-bold text-green-500">{{ $userData['applications']['sent'] }}
                                </div>
                                <div class="text-sm text-gray-400">Envoyées</div>
                            </div>
                            <div class="stat-card">
                                <div class="text-xl font-bold text-yellow-500">
                                    {{ $userData['applications']['pending'] }}
                                </div>
                                <div class="text-sm text-gray-400">En attente</div>
                            </div>
                            <div class="stat-card">
                                <div class="text-xl font-bold text-blue-500">
                                    {{ $userData['applications']['interviews'] }}
                                </div>
                                <div class="text-sm text-gray-400">Entretiens</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level Card -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold">Niveau actuel</h2>
                        <i data-lucide="trophy" class="text-yellow-500"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-500">Niveau {{ $userData['level'] }}</div>
                            <div class="text-gray-400">{{ $userData['title'] }}</div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span>XP</span>
                                <span>{{ $userData['xp']['current'] }}/{{ $userData['xp']['max'] }}</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill-yellow"
                                    style="width: {{ ($userData['xp']['current'] / $userData['xp']['max']) * 100 }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Objectives Card -->
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold">Objectifs du jour</h2>
                        <i data-lucide="target" class="text-blue-500"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="objective-card">
                            <div class="flex items-center space-x-3">
                                <i data-lucide="briefcase" class="text-blue-500"></i>
                                <span>Postuler à 3 offres</span>
                            </div>
                            <div class="text-sm">1/3</div>
                        </div>
                        <div class="objective-card">
                            <div class="flex items-center space-x-3">
                                <i data-lucide="star" class="text-yellow-500"></i>
                                <span>Compléter votre profil</span>
                            </div>
                            <div class="text-sm">80%</div>
                        </div>
                        <div class="objective-card">
                            <div class="flex items-center space-x-3">
                                <i data-lucide="users" class="text-purple-500"></i>
                                <span>Rejoindre la communauté</span>
                            </div>
                            <div class="text-green-500">✓</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Internships -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold">Stages recommandés</h2>
                    <button class="text-blue-500 hover:text-blue-400 flex items-center">
                        Voir tout <i data-lucide="chevron-right"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recommendedInternships as $internship)
                        <div class="internship-card">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="company-logo">
                                            <i data-lucide="building-2" class="text-blue-500"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">{{ $internship['title'] }}</h3>
                                            <div class="text-gray-400">{{ $internship['company'] }}</div>
                                        </div>
                                    </div>
                                    <button class="text-blue-500 hover:text-blue-400 favorite-button">
                                        <i data-lucide="star"></i>
                                    </button>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-400">
                                        <i data-lucide="map-pin" class="mr-2"></i>
                                        {{ $internship['location'] }}
                                    </div>
                                    <div class="flex items-center text-gray-400">
                                        <i data-lucide="trending-up" class="mr-2"></i>
                                        Match {{ $internship['match'] }}%
                                    </div>
                                </div>
                                <button class="apply-button">
                                    Postuler en 1 clic
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Achievements -->
            <div>
                <h2 class="text-2xl font-semibold mb-6">Badges débloqués</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach ($badges as $badge)
                        <div class="badge-card">
                            <div class="text-{{ $badge['color'] }}-500 flex justify-center mb-2">
                                <i data-lucide="{{ $badge['icon'] }}"></i>
                            </div>
                            <div class="font-medium">{{ $badge['name'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

        @vite(['resources/js/dashboard.js'])

        <script>
            // Initialize Lucide icons
            lucide.createIcons();
        </script>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Déconnexion</button>
        </form>
    </body>

@endsection
