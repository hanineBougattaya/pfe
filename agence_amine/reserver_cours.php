<?php
$title = "Réserver un Cours";
include 'includes/header.php';
include 'config/db.php'; // Connexion à la base de données
include 'includes/navbar.php';

// Récupération des moniteurs et des cours pour le formulaire
try {
    $moniteurs = $pdo->query("SELECT ID_MONITEUR, Nom, Prenom FROM moniteur")->fetchAll(PDO::FETCH_ASSOC);
    $cours = $pdo->query("SELECT ID_COURS, NOM_COURS FROM cours")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de récupération des données : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $id_cours = $_POST['id_cours'];
    $date_reservation = $_POST['date_reservation'];
    $heures = $_POST['heures'];

    // Calcul du prix total : 20 DT/heure jusqu'à 11h, et 15 DT/heure à partir de 12h
    $prix_total = ($heures >= 12) ? (11 * 20 + ($heures - 11) * 18) : $heures * 20;

    $id_moniteur = $_POST['id_moniteur'];

    // Requête pour insérer la réservation
    try {
        $query = $pdo->prepare("INSERT INTO reservation (ID_COURS, DATE_RESERVATION, HEURES, ID_MONITEUR, PRIX_TOTAL, ID_APPRENANT) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute([$id_cours, $date_reservation, $heures, $id_moniteur, $prix_total, $_SESSION['user_id']]);

        // Récupération de l'ID de la réservation
        $id_reservation = $pdo->lastInsertId();

        // Redirection vers la page de confirmation avec l'ID de la réservation
        header('Location: confirmation.php?id_reservation=' . urlencode($id_reservation));
        exit;
    } catch (PDOException $e) {
        die("Erreur d'insertion de la réservation : " . $e->getMessage());
    }
}
?>

<header class="bg-warning text-white text-center py-3">
    <h1>Réserver un Cours</h1>
    <a href="index.php" class="btn btn-light">Retour à l'accueil</a>
</header>

<main class="container my-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Formulaire de Réservation</h5>
        </div>
        <div class="card-body">
            <form method="POST" id="reservationForm">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="id_cours">Choisir un Cours :</label>
                        <select name="id_cours" id="id_cours" class="form-control" required>
                            <?php foreach ($cours as $cours_item): ?>
                                <option value="<?= htmlspecialchars($cours_item['ID_COURS']); ?>">
                                    <?= htmlspecialchars($cours_item['NOM_COURS']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="date_reservation">Date de Réservation :</label>
                        <input type="date" name="date_reservation" id="date_reservation" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="heures">Nombre d'Heures :</label>
                        <input type="number" name="heures" id="heures" class="form-control" required min="1" oninput="calculatePrice()">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Estimation du prix :</label>
                        <p id="prix_estime" class="font-weight-bold">0 DT</p>
                    </div>
                </div>
                <!-- Si aucun moniteur n'est disponible, afficher un message -->
                <?php if (empty($moniteurs)): ?>
                    <div class="alert alert-danger" role="alert">
                        Aucun moniteur n'est disponible pour le moment. Veuillez réessayer plus tard.
                    </div>
                <?php else: ?>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="id_moniteur">Choisir un Moniteur :</label>
                            <select name="id_moniteur" id="id_moniteur" class="form-control" required>
                                <?php foreach ($moniteurs as $moniteur): ?>
                                    <option value="<?= htmlspecialchars($moniteur['ID_MONITEUR']); ?>">
                                        <?= htmlspecialchars($moniteur['Nom']) . ' ' . htmlspecialchars($moniteur['Prenom']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-warning text-white  btn-block">Réserver</button>
                        </div>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</main>

<script>
// Fonction pour calculer et afficher le prix en direct
function calculatePrice() {
    var heures = document.getElementById('heures').value;
    var prixEstime = 0;

    if (heures >= 12) {
        prixEstime = (11 * 20) + ((heures - 11) * 18);
    } else {
        prixEstime = heures * 20;
    }

    document.getElementById('prix_estime').textContent = prixEstime + ' DT';
}
</script>

<?php include 'includes/footer.php'; ?>
