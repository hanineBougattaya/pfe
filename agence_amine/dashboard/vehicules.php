<?php
$title = "Gérer les Véhicules"; 
include '../includes/header.php'; 
include '../config/db.php'; // Connexion à la base de données
include '../includes/navbar.php';
include '../includes/navbarDashboard.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
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
try {
    $vehicules = $pdo->query("SELECT * FROM vehicule")->fetchAll();
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des véhicules : " . $e->getMessage();
    exit;
}
?>

<header class="text-center">
    <h1>Gérer les Véhicules</h1>
</header>
<main class="container my-5">
    <div class="welcome-card">
        <p>Voici la liste des véhicules. Vous pouvez ajouter, modifier ou supprimer des véhicules à partir de cette page.</p>
    </div>
    <div class="card-table">
        <h2 class="mb-4">Liste des Véhicules</h2>
        <a href="/dashboard/vehicules/ajouter_vehicule.php" class="btn btn-success mb-3">Ajouter un Véhicule</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead style="background-color: #ffc107; color: #ffffff;">
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
                    <?php if (!$vehicules || empty($vehicules)) : ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucun véhicule trouvé dans la base de données.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($vehicules as $vehicule) : ?>
                            <tr>
                                <td><?= htmlspecialchars($vehicule['ID_VEHICULE']); ?></td>
                                <td><?= htmlspecialchars($vehicule['Type_Vehicule']); ?></td>
                                <td><?= htmlspecialchars($vehicule['Marque']); ?></td>
                                <td><?= htmlspecialchars($vehicule['Modele']); ?></td>
                                <td><?= htmlspecialchars($vehicule['Immatriculation']); ?></td>
                                <td>
                                    <a href="/dashboard/vehicules/modifier_vehicule.php?id=<?= urlencode($vehicule['ID_VEHICULE']); ?>" class="btn btn-warning btn-sm">Modifier</a>
                                    <a href="/dashboard/vehicules.php?delete=<?= urlencode($vehicule['ID_VEHICULE']); ?>" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
