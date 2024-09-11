<?php
session_start();
include 'db.php'; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Récupérer les messages de contact
$query = $pdo->query("SELECT * FROM messages ORDER BY date DESC");
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages de Contact - Tableau de Bord</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #ffffff; /* Blanc pour l'arrière-plan */
        }

        header {
            background-color: #ffc107; /* Jaune pour l'arrière-plan */
            color: #ffffff; /* Blanc pour le texte */
            padding: 20px;
        }

        header h1 {
            font-size: 2.5rem;
            color: #ffffff; /* Blanc pour le titre */
        }

        nav ul {
            padding: 0;
            list-style: none;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: #ffffff; /* Blanc pour les liens */
            text-decoration: none;
        }

        nav ul li a:hover {
            color: #212529; /* Gris foncé pour les liens au survol */
        }

        main {
            padding: 20px;
        }

        .card {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
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

    <!-- Scripts nécessaires pour Bootstrap et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
