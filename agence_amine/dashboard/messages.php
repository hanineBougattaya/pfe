<?php
$title = "Messagerie"; 
include '../includes/header.php'; 
include '../config/db.php';
include '../includes/navbar.php';
include '../includes/navbarDashboard.php';

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

// Récupération des messages
$messages = $pdo->query("SELECT * FROM messages ORDER BY date DESC")->fetchAll();
?>

<header class="text-center mb-4">
    <h1>Messagerie</h1>
</header>

<main class="container">
    <h2 class="text-center mb-4">Liste des Messages de Contact</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead >
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
    </div>
</main>

<?php include '../includes/footer.php'; ?>
