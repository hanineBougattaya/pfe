<?php
session_start();

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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Véhicule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #343a40;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        .navbar a:hover {
            background-color: #495057;
        }
        .container {
            padding: 20px;
        }
        .container h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }
        .form-container button {
            background-color: #ffc107;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #e0a800;
        }
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
   
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

    <div class="footer">
        <p>&copy; 2024 Auto École. Tous droits réservés.</p>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
