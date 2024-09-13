<?php
$title = "Réservations";
include '../includes/header.php';
include '../config/db.php'; // Connexion à la base de données
include '../includes/navbar.php';
include '../includes/navbarDashboard.php';

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

// Récupérer toutes les réservations
try {
    $query = $pdo->query("SELECT * FROM reservation");
    $reservations = $query->fetchAll(PDO::FETCH_ASSOC); // Assurez-vous de récupérer les résultats sous forme de tableau associatif
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des réservations: " . $e->getMessage();
    error_log($error_message); // Enregistre l'erreur dans les logs du serveur
}
?>

<header class="text-center">
    <h1>Gestion des Réservations</h1>
</header>

<main class="container my-5">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php elseif ($reservations): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date de Réservation</th>
                        <th>Heures</th>
                        <th>Moniteur</th>
                        <th>Statut</th>
                        <th>Statut Paiement</th>
                        <th>Remarques</th>
                        <th>Prix Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['ID_RESERVATION']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['DATE_RESERVATION']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['HEURES']); ?></td>
                            <td>
                                <?php
                                // Récupérer le nom du moniteur
                                $moniteur_query = $pdo->prepare("SELECT Nom, Prenom FROM moniteur WHERE ID_MONITEUR = ?");
                                $moniteur_query->execute([$reservation['ID_MONITEUR']]);
                                $moniteur = $moniteur_query->fetch(PDO::FETCH_ASSOC);
                                echo $moniteur ? htmlspecialchars($moniteur['Nom'] . ' ' . $moniteur['Prenom']) : 'Moniteur non trouvé';
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($reservation['STATUT']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['STATUT_PAIEMENT']); ?></td>
                            <td>
                                <?php if ($reservation['REMARQUES']): ?>
                                    <?php echo htmlspecialchars($reservation['REMARQUES']); ?>
                                    <a href="/dashboard/reservations/ajouter_remarques.php?id=<?= urlencode($reservation['ID_RESERVATION']); ?>" class="btn btn-secondary btn-sm">Modifier</a>
                                <?php else: ?>
                                    <a href="/dashboard/reservations/ajouter_remarques.php?id=<?= urlencode($reservation['ID_RESERVATION']); ?>" class="btn btn-secondary btn-sm">Ajouter Remarques</a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($reservation['PRIX_TOTAL']); ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <?php if ($reservation['STATUT'] === 'En attente'): ?>
                                        <a href="/dashboard/reservations/accepter_reservation.php?id=<?= urlencode($reservation['ID_RESERVATION']); ?>" class="btn btn-success btn-sm">Accepter</a>
                                        <a href="/dashboard/reservations/rejet_reservation.php?id=<?= urlencode($reservation['ID_RESERVATION']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir refuser cette réservation ?')" class="btn btn-danger btn-sm">Refuser</a>
                                    <?php elseif ($reservation['STATUT'] === 'Acceptée'): ?>
                                        <?php if ($reservation['STATUT_PAIEMENT'] === 'Non payé'): ?>
                                            <a href="/dashboard/reservations/confirmer_paiement.php?id=<?= urlencode($reservation['ID_RESERVATION']); ?>" class="btn btn-warning text-white btn-sm">Marquer comme Payé</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>Aucune réservation trouvée.</p>
    <?php endif; ?>
</main>

<?php include '../includes/footer.php'; ?>
