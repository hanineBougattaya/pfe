<?php
$title = "Gérer les Apprenants"; 
include '../includes/header.php'; 
include '../config/db.php'; // Connexion à la base de données
include '../includes/navbar.php';
include '../includes/navbarDashboard.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit;
}

// Suppression d'un apprenant
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM apprenant WHERE ID_APPRENANT = ?")->execute([$id]);
    header('Location: /dashboard/apprenants.php');
    exit;
}

// Récupérer la liste des apprenants
try {
    $apprenants = $pdo->query("SELECT * FROM apprenant")->fetchAll();
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des apprenants : " . $e->getMessage();
    exit;
}
?>

<header class="text-center">
    <h1>Gérer les Apprenants</h1>
</header>
<main class="container my-5">
    <div class="welcome-card">
        <p>Voici la liste des apprenants. Vous pouvez ajouter, modifier ou supprimer des apprenants à partir de cette page.</p>
    </div>
    <div class="card-table">
        <h2 class="mb-4">Liste des Apprenants</h2>
        <a href="/dashboard/utils/ajouter_apprenant.php" class="btn btn-success mb-3">Ajouter un Apprenant</a>
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
                    <?php if (!$apprenants || empty($apprenants)) : ?>
                        <tr>
                            <td colspan="8" class="text-center">Aucun apprenant trouvé dans la base de données.</td>
                        </tr>
                    <?php else : ?>
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
                                    <a href="/dashboard/utils/modifier_apprenant.php?id=<?= urlencode($apprenant['ID_APPRENANT']); ?>" class="btn btn-warning btn-sm">Modifier</a>
                                    <a href="/dashboard/apprenants.php?delete=<?= urlencode($apprenant['ID_APPRENANT']); ?>" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-danger btn-sm">Supprimer</a>
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
