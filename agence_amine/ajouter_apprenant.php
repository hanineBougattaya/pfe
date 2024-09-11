<?php
session_start();
include 'db.php'; // Connexion à la base de données

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Requête pour insérer un nouvel apprenant
    $query = $pdo->prepare("INSERT INTO apprenant (Nom, Prenom, DATE_NAISSANCE, ADRESSE, TELEPHONE, EMAIL, login, password, Date_Inscription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $password, date('Y-m-d')]);

    header('Location: apprenants.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Apprenant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #ffffff; /* Blanc pour l'arrière-plan */
            overflow: hidden;
        }
        header {
            background-color: #ffc107; /* Jaune pour l'arrière-plan */
            color: #ffffff; /* Blanc pour le texte */
            padding: 20px;
            text-align: center;
        }
        header h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        nav ul {
            padding: 0;
            list-style: none;
            background-color: #343a40; /* Gris foncé pour la barre de navigation */
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin-right: 15px;
        }
        nav ul li a {
            color: #ffffff; /* Blanc pour les liens */
            text-decoration: none;
            padding: 5px 10px;
        }
        nav ul li a:hover {
            color: #ffc107; /* Jaune pour les liens au survol */
            background-color: #212529; /* Changement de couleur au survol */
            border-radius: 5px;
        }
        .container {
            padding: 20px;
        }
        .card {
            opacity: 0; /* Ajout d'une animation de fade-in */
            transition: opacity 1s ease-in;
        }
        .card-body {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .sticker {
            position: absolute;
            z-index: 1;
            width: 100px; /* Ajuster la taille si nécessaire */
            height: auto;
        }
        .sticker.top-left {
            top: 10px;
            left: 10px;
        }
        .sticker.top-right {
            top: 10px;
            right: 10px;
        }
        .sticker.bottom-left {
            bottom: 10px;
            left: 10px;
        }
        .sticker.bottom-right {
            bottom: 10px;
            right: 10px;
        }
        .sticker.center {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ajouter un Apprenant</h1>
        <a href="apprenants.php" class="btn btn-light">Retour à la liste des apprenants</a>
    </header>

   

    <div class="container my-4">
        <div class="card">
          
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date_naissance">Date de Naissance :</label>
                        <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse :</label>
                        <input type="text" name="adresse" id="adresse" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone :</label>
                        <input type="text" name="telephone" id="telephone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="login">Login :</label>
                        <input type="text" name="login" id="login" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de Passe :</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Images décoratives -->
    <img src="images/image1.jpg" alt="Sticker" class="sticker top-left">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Animation pour la carte
            $('.card').css('opacity', 1);

            // Désactivation du bouton de soumission lors de l'envoi du formulaire
            $('form').on('submit', function() {
                $(this).find('button[type="submit"]').attr('disabled', true);
                $(this).find('button[type="submit"]').text('Envoi...');
            });
        });
    </script>
</body>
</html>
