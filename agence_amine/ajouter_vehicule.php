<?php
$title = "Ajouter un Véhicule"; 
include 'includes/header.php'; 
session_start();
include 'config/db.php';
// Assurez-vous que l'utilisateur est connecté et a le rôle approprié
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Inclure le fichier de connexion à la base de données
include 'db.php';

// Initialiser les variables
$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $type_vehicule = $_POST['type_vehicule'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $immatriculation = $_POST['immatriculation'];

    // Préparer la requête d'insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO vehicule (Type_Vehicule, Marque, Modele, Immatriculation) VALUES (:type_vehicule, :marque, :modele, :immatriculation)");
    $stmt->bindParam(':type_vehicule', $type_vehicule);
    $stmt->bindParam(':marque', $marque);
    $stmt->bindParam(':modele', $modele);
    $stmt->bindParam(':immatriculation', $immatriculation);

    try {
        if ($stmt->execute()) {
            $success = "Moto a été ajouté avec succès.";
        } else {
            $error = "Erreur lors de l'ajout du Moto. Veuillez réessayer.";
        }
    } catch (PDOException $e) {
        $error = "Erreur lors de l'ajout du véhicule : " . $e->getMessage();
    }
}
?>


   
<div class="container">
    <h1>Ajouter un Moto</h1>
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
        <form action="ajouter_vehicule.php" method="POST">
            <label for="type_vehicule">Type de Moto :</label>
            <input type="text" id="type_vehicule" name="type_vehicule" required>
            
            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="marque" required>
            
            <label for="modele">Modèle :</label>
            <input type="text" id="modele" name="modele" required>
            
            <label for="immatriculation">Immatriculation :</label>
            <input type="text" id="immatriculation" name="immatriculation" required>
            
            <button type="submit">Ajouter Moto</button>
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
