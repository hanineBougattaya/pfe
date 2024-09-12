<?php
$title = "Gérer les Moniteurs"; //
include 'includes/header.php'; 
include 'config/db.php';

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
<?php include 'includes/navbar.php'; ?>

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
<?php include 'includes/footer.php'; ?>