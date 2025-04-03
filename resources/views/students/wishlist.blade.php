@extends('students.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <!-- Wishlist Section -->
        <section id="wishlist" class="section-content active">
            <div class="section-header">
                <h1>Ma Wishlist</h1>
                <div class="filters">
                    <button class="filter-btn active">Toutes</button>
                    <button class="filter-btn">Tech</button>
                    <button class="filter-btn">Design</button>
                    <button class="filter-btn">Marketing</button>
                </div>
            </div>
            <div class="offers-grid" id="wishlistGrid">
                <!-- Les offres sauvegardées seront générées dynamiquement ici -->
            </div>
            <div class="pagination" id="wishlistPagination">
                <!-- Les boutons de pagination seront générés dynamiquement ici -->
            </div>
        </section>
    </div>
@endsection
