@extends('layout.noapp')

@section('title', ucfirst($page))

@push('styles')
    @vite(['file' => "resources/css/{$page}.css"])
@endpush

@section('content')

    <div class="auth-container">
        <div class="auth-card">
            <h2>Connexion</h2>

            {{-- Le conteneur d'erreurs sera ajouté dynamiquement par le script --}}
            <form id="loginForm" class="auth-form" method="POST" action="{{ route('login.post') }}">
                @csrf
                <div id="messageContainer" class="alert" style="display: none;"></div>
                <br>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="toggle-password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="form-footer">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn btn-secondary">
                    Se connecter
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
    @vite(['resources/js/auth.js'])
@endsection
