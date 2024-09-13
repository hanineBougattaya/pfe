<?php
$title = "Tableau de bord";
include 'includes/header.php'; 
include 'config/db.php';
include 'includes/navbar.php';
include 'includes/navbarDashboard.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}
?>

<main class="container mt-4">
    <div class="welcome-message alert alert-info">
        <h2 class="alert-heading">Bienvenue dans votre tableau de bord !</h2>
        <p>Choisissez une action dans le menu pour gérer les différents aspects de l'application.</p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
