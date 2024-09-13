<?php 
$title = "Accueil - Auto École Ahmed"; 
include 'includes/header.php'; 
include 'includes/navbar.php'; 
?>

<header class="hero y text-white text-center py-5">
    <h1 class="display-4">Bienvenue chez Auto École Ahmed</h1>
    <p class="lead">Votre réussite est notre priorité. Découvrez notre formation de conduite adaptée à vos besoins.</p>
    <a href="reserver_cours.php" class="btn btn-light btn-lg">Réservez un Cours</a>
</header>

<main class="container my-5">
    <section class="row text-center">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Nos Services</h5>
                    <p class="card-text">Explorez nos services de formation complète pour vous préparer efficacement à l'examen de conduite.</p>
                    <a href="services.php" class="btn btn-warning text-white ">En savoir plus</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">À Propos de Nous</h5>
                    <p class="card-text">Découvrez l'histoire et la mission de notre auto-école, et rencontrez notre équipe d'experts.</p>
                    <a href="about.php" class="btn btn-warning text-white ">En savoir plus</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Contactez-Nous</h5>
                    <p class="card-text">Avez-vous des questions ou souhaitez-vous prendre rendez-vous ? Contactez-nous facilement.</p>
                    <a href="contact.php" class="btn btn-warning text-white ">Nous Contacter</a>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center my-5">
        <h2 class="display-4">Pourquoi Choisir Auto École Ahmed ?</h2>
        <p class="lead">Nous offrons une approche personnalisée, des instructeurs expérimentés et des résultats probants. Rejoignez-nous pour une formation de conduite qui vous prépare au succès.</p>
        <a href="services.php" class="btn btn-warning text-white  btn-lg">Découvrez Nos Services</a>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
