@extends('layout.app')

@section('title', ucfirst($page))

@section('content')

    <div class="container">
        <h1>{{ ucfirst($page) }}</h1>
        <br>
        <p>This is the {{ $page }} page.</p>
    </div>

@endsection
