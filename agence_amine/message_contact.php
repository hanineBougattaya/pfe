<?php
$title = "Messages de Contact - Tableau de Bord"; //
include 'includes/header.php'; 
session_start();
include 'config/db.php';

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Récupérer les messages de contact
$query = $pdo->query("SELECT * FROM messages ORDER BY date DESC");
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<header class="text-center">
    <h1>Messages de Contact</h1>
    <nav>
        <ul>
            <li><a href="dashboard.php">Tableau de Bord</a></li>
            <li><a href="apprenants.php">Gérer les Apprenants</a></li>
            <li><a href="moniteurs.php">Gérer les Moniteurs</a></li>
            <li><a href="vehicules.php">Gérer les Véhicules</a></li>
            <li><a href="reservations.php">Gérer les Réservations</a></li>
            <li><a href="message_contact.php">Messages de Contact</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>
<main class="container">
    <h2>Liste des Messages de Contact</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message) : ?>
            <tr>
                <td><?= htmlspecialchars($message['id']); ?></td>
                <td><?= htmlspecialchars($message['name']); ?></td>
                <td><?= htmlspecialchars($message['email']); ?></td>
                <td><?= nl2br(htmlspecialchars($message['message'])); ?></td>
                <td><?= htmlspecialchars($message['date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include 'includes/footer.php'; ?>
