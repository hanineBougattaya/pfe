<?php
$title = "véhicules"; //
include 'includes/header.php'; 
session_start();
include 'config/db.php'; // Connexion à la base de données

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
<script>
    // Animation d'apparition en fondu pour les éléments
    $(document).ready(function() {
        $('.welcome-card').css('opacity', 0).animate({opacity: 1}, 1500); // Animation de fondu pour la carte de bienvenue
        $('.card-table').css('opacity', 0).delay(500).animate({opacity: 1}, 1500); // Animation de fondu pour le tableau avec délai
        $('.btn').css('opacity', 0).delay(1000).animate({opacity: 1}, 1500); // Animation de fondu pour les boutons avec délai
    });
</script>
<?php include 'includes/footer.php'; ?>
