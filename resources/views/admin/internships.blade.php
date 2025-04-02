@extends('admin.app')

@section('title', ucfirst($page))

@section('content')
        <!-- Dashboard Content -->
        <div class="dashboard-content">
          <section id="internships" class="section-content active">
            <div class="section-header">
              <h1>Gestion des Offres</h1>
              <button class="btn btn-primary" id="addInternship">
                <i class="fas fa-plus"></i> Nouvelle offre
              </button>
            </div>
            <div class="filters">
              <button class="filter-btn active">Toutes</button>
              <button class="filter-btn">En attente</button>
              <button class="filter-btn">Validées</button>
              <button class="filter-btn">Pourvues</button>
            </div>
            <div class="data-table">
              <table>
                <thead>
                  <tr>
                    <th>Titre</th>
                    <th>Entreprise</th>
                    <th>Candidatures</th>
                    <th>Statut</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Développeur Full-Stack</td>
                    <td>
                      <div class="company-info">
                        <img
                          src="https://ui-avatars.com/api/?name=Tech+Corp"
                          alt="Company"
                        />
                        <span>TechCorp</span>
                      </div>
                    </td>
                    <td>15</td>
                    <td>
                      <span class="status active">Active</span>
                    </td>
                    <td>
                      <div class="actions">
                        <button class="btn-icon" title="Modifier">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="Supprimer">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Data Analyst</td>
                    <td>
                      <div class="company-info">
                        <img
                          src="https://ui-avatars.com/api/?name=Data+Insight"
                          alt="Company"
                        />
                        <span>DataInsight</span>
                      </div>
                    </td>
                    <td>8</td>
                    <td>
                      <span class="status pending">En attente</span>
                    </td>
                    <td>
                      <div class="actions">
                        <button class="btn-icon" title="Modifier">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="Supprimer">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </main>
    </div>
    <div id="internshipModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Ajouter une offre de stage</h2>
        <form id="internshipForm">
          <div class="form-group">
            <label for="title">Titre de l'offre :</label>
            <input type="text" id="title" placeholder="Entrez le titre" />
          </div>
          <div class="form-group">
            <label for="companySearch">Rechercher une entreprise :</label>
            <input
              type="text"
              id="companySearch"
              placeholder="Recherchez une entreprise"
            />
            <ul
              id="companyDropdown"
              class="dropdown-menu"
              style="display: none"
            >
              <!-- Liste des entreprises générée dynamiquement -->
            </ul>
            <p
              id="selectedCompany"
              style="margin-top: 10px; font-weight: bold"
            ></p>
          </div>
          <div class="form-group">
            <label for="description">Description de l'offre :</label>
            <textarea
              id="description"
              placeholder="Entrez la description"
            ></textarea>
          </div>
          <div class="form-group">
            <label for="skills">Rechercher des compétences :</label>
            <input
              type="text"
              id="skillsSearch"
              placeholder="Recherchez des compétences"
            />
            <ul id="skillsDropdown" class="dropdown-menu" style="display: none">
              <!-- Liste des compétences générée dynamiquement -->
            </ul>
          </div>
          <div class="form-group">
            <label>Compétences sélectionnées :</label>
            <table id="selectedSkillsTable" class="data-table">
              <thead>
                <tr>
                  <th>Compétence</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- Compétences sélectionnées affichées ici -->
              </tbody>
            </table>
          </div>
          <div class="modal-actions">
            <button type="submit" class="btn-primary">Ajouter</button>
            <button type="button" class="btn-secondary close">Annuler</button>
          </div>
        </form>
      </div>
    </div>
@endsection
