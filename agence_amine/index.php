<?php 
$title = "Accueil - Auto École"; //
include 'includes/header.php'; 
?>


<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Auto École</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="services.php">Nos Services</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">À Propos</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-user"></i> Connexion </a>
            </li>
        </ul>
    </div>
</nav>
<div class="hero">
    <h1>Bienvenue chez Auto École</h1>
    <p>Découvrez nos services de formation et passez votre permis avec les meilleurs.</p>
    <a href="services.php" class="btn btn-light btn-lg">Nos Services</a>
</div>
<div class="container">
    <h2 class="section-title">Nos Services</h2>
    <div class="section-content">
        <p>Nous offrons une gamme complète de services pour vous aider à réussir votre permis de conduire :</p>
        <ul>
            <li>Formation théorique et pratique</li>
            <li>Leçons personnalisées</li>
            <li>Évaluations régulières</li>
            <li>Assistance pour les examens</li>
        </ul>
    </div>
    <h2 class="section-title">À Propos de Nous</h2>
    <div class="section-content">
        <p>Auto École est dédiée à fournir une formation de qualité pour vous aider à atteindre vos objectifs de conduite. Notre équipe d'instructeurs expérimentés est là pour vous guider à chaque étape du processus.</p>
    </div>
    <h2 class="section-title">Réservez Votre Cours</h2>
   
    <a href="reserver_cours.php" class="btn btn-primary">Réserver</a>
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
