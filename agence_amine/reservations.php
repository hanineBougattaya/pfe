<?php
session_start();
include 'db.php'; // Connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

try {
    // Requête pour obtenir les réservations de l'utilisateur
    if ($role === 'apprenant') {
        $query = $pdo->prepare("SELECT * FROM reservation WHERE ID_APPRENANT = ?");
    } else if ($role === 'moniteur') {
        $query = $pdo->prepare("SELECT * FROM reservation WHERE ID_MONITEUR = ?");
    } else {
        throw new Exception('Role inconnu');
    }
    
    // Vérifiez si la requête est définie avant de l'exécuter
    if ($query) {
        $query->execute([$user_id]);
        $reservations = $query->fetchAll();
    } else {
        throw new Exception('Erreur de préparation de la requête');
    }
} catch (Exception $e) {
    $error_message = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <h1>Auto École</h1>
        </div>
        <div class="links">
            <a href="home.php">Accueil</a>
            <a href="logout.php">Déconnexion</a>
        </div>
    </div>

    <div class="container">
        <h1>Mes Réservations</h1>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php elseif ($reservations): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Moniteur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['ID_RESERVATION']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['DATE_RESERVATION']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['HEURE_RESERVATION']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['ID_MONITEUR']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>
</body>
</html>
