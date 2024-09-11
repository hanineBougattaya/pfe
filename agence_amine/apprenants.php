<?php
session_start();
include 'db.php'; // Connexion à la base de données

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Suppression d'un apprenant
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM apprenant WHERE ID_APPRENANT = ?")->execute([$id]);
    header('Location: apprenants.php');
    exit;
}

// Récupérer la liste des apprenants
$apprenants = $pdo->query("SELECT * FROM apprenant")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Apprenants</title>
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
            background-color: #343a40; /* Gris foncé pour la barre de navigation */
            padding: 10px;
            margin-bottom: 20px;
        }
        nav ul li {
            display: inline;
            margin-right: 15px;
        }
        nav ul li a {
            color: #ffffff; /* Blanc pour les liens */
            text-decoration: none;
            padding: 5px 10px;
        }
        nav ul li a:hover {
            color: #ffc107; /* Jaune pour les liens au survol */
            background-color: #212529; /* Changement de couleur au survol */
            border-radius: 5px;
        }
        .container {
            padding: 20px;
        }
        .table {
            opacity: 0; /* Ajout d'une animation de fade-in */
            transition: opacity 1s ease-in;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="display-4">Gérer les Apprenants</h1>
    </header>

   

    <div class="container my-5">
        <h2 class="mb-4">Liste des Apprenants</h2>
        <a href="ajouter_apprenant.php" class="btn btn-success mb-3">Ajouter un Apprenant</a>
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
                    <?php foreach ($apprenants as $apprenant) : ?>
                    <tr>
                        <td><?= htmlspecialchars($apprenant['ID_APPRENANT']); ?></td>
                        <td><?= htmlspecialchars($apprenant['Nom']); ?></td>
                        <td><?= htmlspecialchars($apprenant['Prenom']); ?></td>
                        <td><?= htmlspecialchars($apprenant['Date_Naissance']); ?></td>
                        <td><?= htmlspecialchars($apprenant['Adresse']); ?></td>
                        <td><?= htmlspecialchars($apprenant['Telephone']); ?></td>
                        <td><?= htmlspecialchars($apprenant['Email']); ?></td>
                        <td>
                            <a href="modifier_apprenant.php?id=<?= urlencode($apprenant['ID_APPRENANT']); ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="apprenants.php?delete=<?= urlencode($apprenant['ID_APPRENANT']); ?>" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- jQuery pour les animations -->
    <script>
        $(document).ready(function() {
            // Animation pour le tableau
            $('.table').css('opacity', 1);
        });
    </script>
</body>
</html>
