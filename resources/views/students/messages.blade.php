@extends('students.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <section id="messages" class="section-content active">
            <h1>Messagerie</h1>
            <div class="messaging-container">
                <div class="contacts-list">
                    <div class="search-messages">
                        <input type="text" placeholder="Rechercher une conversation..." />
                    </div>
                    <div class="contact active">
                        <img src="https://ui-avatars.com/api/?name=Marie+Martin" alt="Contact" />
                        <div class="contact-info">
                            <h4>Marie Martin</h4>
                            <p>Merci pour l'information sur...</p>
                        </div>
                        <div class="contact-meta">
                            <span class="time">14:23</span>
                            <span class="unread">2</span>
                        </div>
                    </div>
                    <div class="contact">
                        <img src="https://ui-avatars.com/api/?name=Tech+Corp" alt="Contact" />
                        <div class="contact-info">
                            <h4>TechCorp RH</h4>
                            <p>Concernant la candidature de...</p>
                        </div>
                        <div class="contact-meta">
                            <span class="time">Hier</span>
                        </div>
                    </div>
                    <div class="contact">
                        <img src="https://ui-avatars.com/api/?name=Lucas+Dubois" alt="Contact" />
                        <div class="contact-info">
                            <h4>Lucas Dubois</h4>
                            <p>J'ai bien reçu le contrat...</p>
                        </div>
                        <div class="contact-meta">
                            <span class="time">Lun</span>
                        </div>
                    </div>
                </div>
                <div class="chat-container">
                    <div class="chat-header">
                        <img src="https://ui-avatars.com/api/?name=Marie+Martin" alt="Contact" />
                        <div class="chat-contact-info">
                            <h4>Marie Martin</h4>
                            <p>En ligne</p>
                        </div>
                    </div>
                    <div class="messages">
                        <div class="message received">
                            <p>
                                Bonjour, j'ai une question concernant l'offre de stage
                                chez TechCorp
                            </p>
                            <span class="time">14:20</span>
                        </div>
                        <div class="message sent">
                            <p>Bien sûr, que souhaitez-vous savoir ?</p>
                            <span class="time">14:21</span>
                        </div>
                        <div class="message received">
                            <p>Est-ce que le télétravail est possible ?</p>
                            <span class="time">14:22</span>
                        </div>
                        <div class="message sent">
                            <p>
                                Oui, l'entreprise propose 2 jours de télétravail par
                                semaine.
                            </p>
                            <span class="time">14:23</span>
                        </div>
                    </div>
                    <div class="message-input">
                        <input type="text" placeholder="Écrivez votre message..." />
                        <button class="send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
