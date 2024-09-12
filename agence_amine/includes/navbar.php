<?php
// Démarrer la session
session_start();
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
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Si la session est active, afficher les liens "Dashboard" et "Déconnexion" -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </li>
            <?php else: ?>
                <!-- Si aucune session active, afficher le lien "Connexion" -->
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fas fa-user"></i> Connexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
