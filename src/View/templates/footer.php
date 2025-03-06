<?php
// src/View/layout/footer.php
?>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Section "À propos" -->
            <div class="footer-section">
                <h3>À propos</h3>
                <ul>
                    <li><a href="index.php?page=a_propos/about">Qui sommes-nous</a></li>
                    <li><a href="index.php?page=a_propos/blog">Blog</a></li>
                    <li><a href="index.php?page=a_propos/carrieres">Carrières</a></li>
                </ul>
            </div>
            <!-- Section "Ressources" -->
            <div class="footer-section">
                <h3>Ressources</h3>
                <ul>
                    <li><a href="#">Guide</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            <!-- Section "Légal" -->
            <div class="footer-section">
                <h3>Légal</h3>
                <ul>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">CGU</a></li>
                    <li><a href="#">Confidentialité</a></li>
                </ul>
            </div>
            <!-- Section "Suivez-nous" -->
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <ul>
                    <li><a href="#">LinkedIn</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <!-- Affichage dynamique de l'année en cours -->
            <p>&copy; <?= date("Y") ?> WorknGo. Tous droits réservés.</p>
        </div>
    </div>
</footer>
<!-- Inclusion du script JavaScript global -->
<script src="assets/js/script.js"></script>
</body>

</html>
