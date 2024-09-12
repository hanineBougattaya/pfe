<!-- footer.php -->
    <footer>
        <p>&copy; 2024 Auto École. Tous droits réservés.</p>
    </footer>
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Animation d'apparition en fondu pour les éléments
        $(document).ready(function() {
            $('.welcome-card').css('opacity', 0).animate({opacity: 1}, 1500); // Animation de fondu pour la carte de bienvenue
            $('.card-table').css('opacity', 0).delay(500).animate({opacity: 1}, 1500); // Animation de fondu pour le tableau avec délai
            $('.btn').css('opacity', 0).delay(1000).animate({opacity: 1}, 1500); // Animation de fondu pour les boutons avec délai
        });
    </script>
    <script>
        $(document).ready(function() {
            // Animation pour la carte
            $('.card').css('opacity', 1);

            // Désactivation du bouton de soumission lors de l'envoi du formulaire
            $('form').on('submit', function() {
                $(this).find('button[type="submit"]').attr('disabled', true);
                $(this).find('button[type="submit"]').text('Envoi...');
            });
        });
    </script>
</body>
</html>
