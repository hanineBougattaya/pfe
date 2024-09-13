<?php
$title = "Réservations"; 
include '../includes/header.php'; 
include '../config/db.php'; // Connexion à la base de données
include '../includes/navbar.php';
include '../includes/navbarDashboard.php';

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
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
    } else if ($role === 'admin') {
        $query = $pdo->prepare("SELECT * FROM reservation");
    } else {
        throw new Exception('Rôle inconnu');
    }
    
    // Vérifiez si la requête est définie avant de l'exécuter
    if ($query) {
        // Exécution de la requête en utilisant les paramètres appropriés
        if ($role === 'admin') {
            $query->execute();
        } else {
            $query->execute([$user_id]);
        }
        $reservations = $query->fetchAll();
    } else {
        throw new Exception('Erreur de préparation de la requête');
    }
} catch (Exception $e) {
    $error_message = $e->getMessage();
}
?>

<header class="text-center">
    <h1>Mes Réservations</h1>
</header>

<main class="container my-5">
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php elseif ($reservations): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de Réservation</th>
                    <th>Heures</th>
                    <th>Moniteur</th>
                    <th>Statut</th>
                    <th>Prix Total</th>
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
                            $moniteur = $moniteur_query->fetch();
                            echo htmlspecialchars($moniteur['Nom'] . ' ' . $moniteur['Prenom']);
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($reservation['STATUT']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['PRIX_TOTAL']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune réservation trouvée.</p>
    <?php endif; ?>
</main>

<?php include '../includes/footer.php'; ?>
