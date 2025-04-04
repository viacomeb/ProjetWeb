@extends('students.app')

@section('title', 'Communauté')

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <!-- Community Section -->
        <section id="community" class="section-content active">
            <div class="section-container">
                <div class="community-header">
                    <h2>Espace Communauté</h2>
                    <button class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Nouvelle discussion
                    </button>
                </div>
                <div id="forumPosts" class="forum-posts">
                    <!-- Les posts seront générés dynamiquement ici -->
                </div>
                <div id="communityPagination" class="pagination">
                    <!-- Les boutons de pagination seront générés dynamiquement ici -->
                </div>
            </div>
        </section>

        <div id="newDiscussionModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Lancer une nouvelle discussion</h2>
                <form id="communityForm">
                    @csrf
                    <div class="form-group">
                        <label for="communityTitle">Titre :</label>
                        <input type="text" id="communityTitle" placeholder="Entrez le nom" />
                    </div>
                    <div class="form-group">
                        <label for="description">Votre message :</label>
                        <textarea id="description" placeholder="Entrez votre message"></textarea>
                    </div>
                    <div class="modal-actions">
                        <button type="submit" class="btn-primary">Ajouter</button>
                        <button type="button" class="btn-secondary close">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
