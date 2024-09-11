<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Suppression d'un véhicule
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM vehicule WHERE ID_VEHICULE = ?")->execute([$id]);
    header('Location: vehicules.php');
    exit;
}

// Récupérer la liste des véhicules
$vehicules = $pdo->query("SELECT * FROM vehicule")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Motos</title>
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

        .welcome-card {
            background-color: #f8f9fa; /* Gris clair pour le fond de la carte */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Ombre légère */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animation */
            text-align: center;
            opacity: 0;
        }

        .welcome-card:hover {
            transform: scale(1.05); /* Effet de zoom au survol */
            box-shadow: 0 8px 16px rgba(0,0,0,0.2); /* Ombre plus marquée au survol */
        }

        .welcome-card p {
            font-size: 1.5rem; /* Taille du texte */
            font-weight: bold; /* Texte en gras */
            color: #343a40; /* Gris foncé pour le texte */
            line-height: 1.6; /* Hauteur de ligne pour un meilleur espacement */
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1); /* Ombre légère pour le texte */
        }

        .card-table {
            margin-top: 30px;
            opacity: 0;
        }

        .card-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .card-table th, .card-table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        .card-table th {
            background-color: #343a40; /* Gris foncé pour les en-têtes de tableau */
            color: #ffffff; /* Blanc pour le texte */
        }

        .card-table td {
            background-color: #ffffff; /* Blanc pour les cellules */
        }

        .card-table a {
            color: #007bff; /* Bleu pour les liens */
        }

        .card-table a:hover {
            color: #0056b3; /* Bleu plus foncé au survol */
        }

        .btn {
            opacity: 0;
            transition: opacity 1.5s ease;
        }
    </style>
</head>
<body>
    <header class="text-center">
        <h1>Gérer les Motos</h1>
        <a href="dashboard.php" class="btn btn-light">Retour au Tableau de bord</a>
    </header>
    <main class="container">
        <div class="welcome-card">
            <p>Voici la liste des motos. Vous pouvez ajouter, supprimer des motos à partir de cette page.</p>
        </div>
        <h2>Liste des motos</h2>
        <a href="ajouter_vehicule.php" class="btn btn-success mb-3">Ajouter une Moto</a>
        <div class="card-table">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Immatriculation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicules as $vehicule) : ?>
                    <tr>
                        <td><?= htmlspecialchars($vehicule['ID_VEHICULE']); ?></td>
                        <td><?= htmlspecialchars($vehicule['Type_Vehicule']); ?></td>
                        <td><?= htmlspecialchars($vehicule['Marque']); ?></td>
                        <td><?= htmlspecialchars($vehicule['Modele']); ?></td>
                        <td><?= htmlspecialchars($vehicule['Immatriculation']); ?></td>
                        <td>
                            <a href="vehicules.php?delete=<?= urlencode($vehicule['ID_VEHICULE']); ?>" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Animation d'apparition en fondu pour les éléments
        $(document).ready(function() {
            $('.welcome-card').css('opacity', 0).animate({opacity: 1}, 1500); // Animation de fondu pour la carte de bienvenue
            $('.card-table').css('opacity', 0).delay(500).animate({opacity: 1}, 1500); // Animation de fondu pour le tableau avec délai
            $('.btn').css('opacity', 0).delay(1000).animate({opacity: 1}, 1500); // Animation de fondu pour les boutons avec délai
        });
    </script>
</body>
</html>
