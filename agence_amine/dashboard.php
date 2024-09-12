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

// Récupérer la liste des messages
$messages = $pdo->query("SELECT * FROM messages ORDER BY date DESC")->fetchAll();
?>

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
