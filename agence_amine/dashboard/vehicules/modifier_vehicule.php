<?php
$title = "Modifier un Véhicule"; 
include '../../includes/header.php'; 
include '../../config/db.php';
include '../../includes/navbar.php'; 

// Assurez-vous que l'utilisateur est connecté et a le rôle approprié
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

// Vérification si un ID véhicule est passé dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: /dashboard/vehicules.php');
    exit;
}

$id = $_GET['id'];

// Initialiser les variables
$success = '';
$error = '';

// Récupérer les informations du véhicule
$query = $pdo->prepare("SELECT * FROM vehicule WHERE ID_VEHICULE = ?");
$query->execute([$id]);
$vehicule = $query->fetch(PDO::FETCH_ASSOC);

if (!$vehicule) {
    // Si aucun véhicule trouvé, redirection
    header('Location: /dashboard/vehicules.php');
    exit;
}

// Traitement du formulaire pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les nouvelles données du formulaire
    $type_vehicule = $_POST['type_vehicule'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];

    // Préparer la requête de mise à jour dans la base de données
    $stmt = $pdo->prepare("UPDATE vehicule SET Type_Vehicule = :type_vehicule, Marque = :marque, Modele = :modele, Immatriculation = :immatriculation WHERE ID_VEHICULE = :id");
    $stmt->bindParam(':type_vehicule', $type_vehicule);
    $stmt->bindParam(':marque', $marque);
    $stmt->bindParam(':modele', $modele);
    $stmt->bindParam(':immatriculation', $immatriculation);
    $stmt->bindParam(':id', $id);

    try {
        if ($stmt->execute()) {
            $success = "Les informations du véhicule ont été mises à jour avec succès.";
        } else {
            $error = "Erreur lors de la mise à jour du véhicule. Veuillez réessayer.";
        }
    } catch (PDOException $e) {
        $error = "Erreur lors de la mise à jour du véhicule : " . $e->getMessage();
    }
}
?>

<header class="text-center">
    <h1>Modifier un Véhicule</h1>
    <a href="/dashboard/vehicules.php" class="btn btn-light">Retour à la liste des véhicules</a>
</header>
<main class="container">
    <div class="form-container">
        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form action="modifier_vehicule.php?id=<?= htmlspecialchars($id) ?>" method="POST">
            <label for="type_vehicule">Type de Véhicule :</label>
            <input type="text" id="type_vehicule" name="type_vehicule" value="<?= htmlspecialchars($vehicule['Type_Vehicule']) ?>" required>
            
            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="marque" value="<?= htmlspecialchars($vehicule['Marque']) ?>" required>
            
            <label for="modele">Modèle :</label>
            <input type="text" id="modele" name="modele" value="<?= htmlspecialchars($vehicule['Modele']) ?>" required>
            
            <label for="immatriculation">Immatriculation :</label>
            <input type="text" id="immatriculation" name="immatriculation" value="<?= htmlspecialchars($vehicule['Immatriculation']) ?>" required>
            
            <button type="submit">Enregistrer les modifications</button>
        </form>
    </div>
</main>
<?php include '../../includes/footer.php'; ?>
