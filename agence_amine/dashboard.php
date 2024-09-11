<?php
$title = "Tableau de bord";
include 'includes/header.php'; 
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer la liste des messages
$messages = $pdo->query("SELECT * FROM messages ORDER BY date DESC")->fetchAll();
?>

<header class="text-center">
    <h1>Tableau de bord</h1>
    <nav>
        <ul>
            <li><a href="apprenants.php">Gérer les Apprenants</a></li>
            <li><a href="moniteurs.php">Gérer les Moniteurs</a></li>
            <li><a href="vehicules.php">Gérer les motos</a></li>
            <li><a href="reservations.php">Gérer les Réservations</a></li>
            <li><a href="contact_messages.php">Messages de Contact</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>
<main class="container">
    <div class="welcome-message alert alert-info" role="alert">
        <h4 class="alert-heading">Bienvenue dans votre tableau de bord !</h4>
        <p>Choisissez une action dans le menu pour gérer les différents aspects de l'application.</p>
        <hr>
        
    </div>
</main>
<?php include 'includes/footer.php'; ?>