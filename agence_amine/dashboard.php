<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer la liste des messages
$messages = $pdo->query("SELECT * FROM messages ORDER BY date DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
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

        .welcome-message {
            margin-bottom: 20px;
            display: none; /* Masqué par défaut pour appliquer l'animation */
        }
    </style>
</head>
<body>
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

    <!-- Scripts nécessaires pour Bootstrap et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Animation pour le message de bienvenue
        $(document).ready(function() {
            $('.welcome-message').fadeIn(2000); // Animation de fondu sur 2 secondes
        });
    </script>
</body>
</html>
