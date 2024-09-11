<?php
$title = "Réserver un Cours"; //
include 'includes/header.php'; 
session_start();
include 'config/db.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupération des moniteurs pour le formulaire
try {
    $moniteurs = $pdo->query("SELECT ID_MONITEUR, nom, prenom FROM moniteur")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de récupération des moniteurs : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $id_cours = $_POST['id_cours'];
    $date_reservation = $_POST['date_reservation'];
    $heures = $_POST['heures'];
    $id_moniteur = $_POST['id_moniteur'];
    $prix_total = $heures * 20; // 20 DT par heure

    // Requête pour insérer la réservation
    try {
        $query = $pdo->prepare("INSERT INTO reservation (ID_COURS, DATE_RESERVATION, HEURES, ID_MONITEUR, PRIX_TOTAL, ID_APPRENANT) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute([$id_cours, $date_reservation, $heures, $id_moniteur, $prix_total, $_SESSION['user_id']]);
        header('Location: confirmation_reservation.php'); // Redirection après la réservation
        exit;
    } catch (PDOException $e) {
        die("Erreur d'insertion de la réservation : " . $e->getMessage());
    }
}
?>

<header class="bg-warning text-white text-center py-3">
    <h1>Réserver un Cours</h1>
    <a href="home.php" class="btn btn-light">Retour à l'accueil</a>
</header>
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Formulaire de Réservation</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id_cours">Choisir un Cours :</label>
                    <select name="id_cours" id="id_cours" class="form-control" required>
                        <option value="code">Code</option>
                        <option value="conduite">Conduite</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_reservation">Date de Réservation :</label>
                    <input type="date" name="date_reservation" id="date_reservation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="heures">Nombre d'Heures :</label>
                    <input type="number" name="heures" id="heures" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="id_moniteur">Choisir un Moniteur :</label>
                    <select name="id_moniteur" id="id_moniteur" class="form-control" required>
                        <?php foreach ($moniteurs as $moniteur): ?>
                            <option value="<?= htmlspecialchars($moniteur['ID_MONITEUR']); ?>">
                                <?= htmlspecialchars($moniteur['nom']) . ' ' . htmlspecialchars($moniteur['prenom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Réserver</button>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>