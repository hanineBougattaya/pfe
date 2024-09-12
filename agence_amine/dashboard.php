<?php
$title = "Tableau de bord";
include 'includes/header.php'; 
include 'config/db.php';
include 'includes/navbar.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer la liste des messages
$messages = $pdo->query("SELECT * FROM messages ORDER BY date DESC")->fetchAll();
?>

<header class="dashboard-header text-white text-center py-4">
        <h1 class="display-4">Tableau de bord</h1>
        <nav>
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="apprenants.php">Gérer les Apprenants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="moniteurs.php">Gérer les Moniteurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="vehicules.php">Gérer les motos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="reservations.php">Gérer les Réservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="contact_messages.php">Messages de Contact</a>
                </li>
            </ul>
        </nav>
</header>

<main class="container mt-4">
    <div class="welcome-message alert alert-info">
        <h4 class="alert-heading">Bienvenue dans votre tableau de bord !</h4>
        <p>Choisissez une action dans le menu pour gérer les différents aspects de l'application.</p>
        <hr>
        <p>Voici un aperçu rapide des dernières informations :</p>
        <ul>
            <?php foreach ($messages as $message): ?>
                <li>
                    <strong><?php echo htmlspecialchars($message['message']); ?></strong> - <?php echo htmlspecialchars($message['date']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
