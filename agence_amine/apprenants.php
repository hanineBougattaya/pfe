<?php
$title = "Gestion des Apprenants"; 
include 'includes/header.php'; 
session_start();
include 'config/db.php';

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
<?php include 'includes/footer.php'; ?>