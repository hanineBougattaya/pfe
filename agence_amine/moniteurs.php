<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Suppression d'un moniteur
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM moniteur WHERE ID_MONITEUR = ?")->execute([$id]);
    header('Location: moniteurs.php');
    exit;
}

// Récupérer la liste des moniteurs
try {
    $moniteurs = $pdo->query("SELECT * FROM moniteur")->fetchAll();
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des moniteurs : " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Moniteurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #ffffff;
        }

        header {
            background-color: #ffc107; /* Jaune pour la barre de navigation */
            color: #ffffff;
            padding: 20px;
        }

        header h1 {
            font-size: 2.5rem;
            color: #ffffff;
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
            color: #ffffff;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: #212529;
        }

        main {
            padding: 20px;
        }

        .welcome-card {
            background-color: #f8f9fa;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            opacity: 0;
        }

        .welcome-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .welcome-card p {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
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
            background-color: #343a40;
            color: #ffffff;
        }

        .card-table td {
            background-color: #ffffff;
        }

        .card-table a {
            color: #007bff;
        }

        .card-table a:hover {
            color: #0056b3;
        }

        .btn {
            opacity: 0;
            transition: opacity 1.5s ease;
        }
    </style>
</head>
<body>
    <header class="text-center">
        <h1>Gérer les Moniteurs</h1>
        <a href="dashboard.php" class="btn btn-light">Retour au Tableau de bord</a>
    </header>
    <main class="container">
        <div class="welcome-card">
            <p>Voici la liste des moniteurs. Vous pouvez ajouter, modifier ou supprimer des moniteurs à partir de cette page.</p>
        </div>
        <div class="card-table">
            <h2 class="mb-4">Liste des Moniteurs</h2>
            <a href="ajouter_moniteur.php" class="btn btn-success mb-3">Ajouter un Moniteur</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de Naissance</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$moniteurs || empty($moniteurs)) : ?>
                            <tr>
                                <td colspan="8" class="text-center">Aucun moniteur trouvé dans la base de données.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($moniteurs as $moniteur) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($moniteur['ID_MONITEUR']); ?></td>
                                    <td><?= htmlspecialchars($moniteur['Nom']); ?></td>
                                    <td><?= htmlspecialchars($moniteur['Prenom']); ?></td>
                                    <td><?= htmlspecialchars($moniteur['Date_Naissance']); ?></td>
                                    <td><?= htmlspecialchars($moniteur['Adresse']); ?></td>
                                    <td><?= htmlspecialchars($moniteur['Telephone']); ?></td>
                                    <td><?= htmlspecialchars($moniteur['Email']); ?></td>
                                    <td>
                                        <a href="modifier_moniteur.php?id=<?= urlencode($moniteur['ID_MONITEUR']); ?>" class="btn btn-warning btn-sm">Modifier</a>
                                        <a href="moniteurs.php?delete=<?= urlencode($moniteur['ID_MONITEUR']); ?>" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-danger btn-sm">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
