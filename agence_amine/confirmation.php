<?php
session_start();
include 'db.php'; // Connexion à la base de données

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Vérification de la présence de l'ID de réservation dans l'URL
if (!isset($_GET['id_reservation'])) {
    die("ID de réservation non spécifié.");
}

// Récupération de l'ID de réservation
$id_reservation = $_GET['id_reservation'];

try {
    // Requête pour obtenir les détails de la réservation
    $query = $pdo->prepare("
        SELECT r.ID_RESERVATION, c.NOM_COURS, r.DATE_RESERVATION, r.HEURES, m.nom AS MONITEUR_NOM, m.prenom AS MONITEUR_PRENOM, r.PRIX_TOTAL
        FROM reservation r
        JOIN cours c ON r.ID_COURS = c.ID_COURS
        JOIN moniteur m ON r.ID_MONITEUR = m.ID_MONITEUR
        WHERE r.ID_RESERVATION = ?
    ");
    $query->execute([$id_reservation]);
    $reservation = $query->fetch(PDO::FETCH_ASSOC);

    if (!$reservation) {
        die("Réservation non trouvée.");
    }
} catch (PDOException $e) {
    die("Erreur de récupération de la réservation : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-warning text-white text-center py-3">
        <h1>Confirmation de Réservation</h1>
        <a href="home.php" class="btn btn-light">Retour à l'accueil</a>
    </header>

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Détails de la Réservation</h5>
            </div>
            <div class="card-body">
                <p><strong>Cours Réservé :</strong> <?= htmlspecialchars($reservation['NOM_COURS']); ?></p>
                <p><strong>Date de Réservation :</strong> <?= htmlspecialchars($reservation['DATE_RESERVATION']); ?></p>
                <p><strong>Nombre d'Heures :</strong> <?= htmlspecialchars($reservation['HEURES']); ?></p>
                <p><strong>Moniteur :</strong> <?= htmlspecialchars($reservation['MONITEUR_NOM']) . ' ' . htmlspecialchars($reservation['MONITEUR_PRENOM']); ?></p>
                <p><strong>Prix Total :</strong> <?= htmlspecialchars($reservation['PRIX_TOTAL']); ?> DT</p>
                <a href="home.php" class="btn btn-primary">Retour à l'accueil</a>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
