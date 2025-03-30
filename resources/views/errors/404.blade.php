@extends('layout.app')

@section('title', content: 404)

@section('content')
    <div style="text-align: center; padding: 100px;">
        <h1>Erreur 404</h1>
        <p>La page que vous recherchez n'existe pas.</p>
        <br>
        <button onclick="window.location.href='{{ route('home') }}'" class="btn btn-outline">Retour à l'accueil</button>
    </div>
@endsection
