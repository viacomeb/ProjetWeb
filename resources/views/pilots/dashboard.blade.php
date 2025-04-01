@extends('layout.noapp')

@section('title', 'Tableau de bord Pilote')

@section('content')
    <h1>Bienvenue sur le tableau de bord des pilotes</h1>
    <p>Ajoutez ici les informations spécifiques au rôle de pilote.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Déconnexion</button>
    </form>
@endsection
