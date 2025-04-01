@extends('layout.noapp')

@section('title', 'Tableau de bord Administrateur')

@section('content')
    <h1>Bienvenue sur le tableau de bord des administrateurs</h1>
    <p>Ajoutez ici les informations spécifiques au rôle d'administrateur.</p>

    <br>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Déconnexion</button>
    </form>
@endsection
