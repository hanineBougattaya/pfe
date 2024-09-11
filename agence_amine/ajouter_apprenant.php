<?php
$title = "Ajouter un Apprenant"; 
include 'includes/header.php'; 
session_start();
include 'config/db.php';

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
<?php include 'includes/footer.php'; ?>