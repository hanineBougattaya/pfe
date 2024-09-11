<?php
session_start();
include 'db.php'; // Connexion à la base de données

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Message de résultat
$message = "";

// Traitement du formulaire pour l'ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $date_embauche = $_POST['date_embauche'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $pdo->prepare("INSERT INTO moniteur (Nom, Prenom, Date_Naissance, Adresse, Telephone, Email, Login, Date_Embauche, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $date_embauche, $password]);

    // Redirection ou message de succès
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Moniteur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #ffffff; /* Blanc pour l'arrière-plan */
        }
        header {
            background-color: #ffc107; /* Jaune pour l'arrière-plan */
            color: #ffffff; /* Blanc pour le texte */
            padding: 20px;
            text-align: center;
        }
        header h1 {
            font-size: 2.5rem;
            color: #ffffff; /* Blanc pour le titre */
        }
        .container {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
        button {
            background-color: #ffc107; /* Jaune */
            color: #ffffff; /* Blanc */
            border: none;
            padding: .5rem 1rem;
            border-radius: .25rem;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background-color: #e0a800; /* Jaune plus foncé au survol */
        }
        .message {
            color: green;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ajouter un Moniteur</h1>
        <a href="moniteurs.php" class="btn btn-light">Retour à la liste des moniteurs</a>
    </header>

    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="POST">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" required>

    <label for="date_naissance">Date de Naissance :</label>
    <input type="date" name="date_naissance" required>

    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" required>

    <label for="telephone">Téléphone :</label>
    <input type="text" name="telephone" required>

    <label for="email">Email :</label>
    <input type="email" name="email" required>

    <label for="login">Login :</label>
    <input type="text" name="login" required>

    <label for="date_embauche">Date d'Embauche :</label>
    <input type="date" name="date_embauche" required>

    <label for="password">Mot de Passe :</label>
    <input type="password" name="password" required>

    <button type="submit">Ajouter Moniteur</button>
</form>

    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
