<?php
$title = "Ajouter Moniteur"; 
include 'includes/header.php'; 
include 'config/db.php';

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
<?php include 'includes/navbar.php'; ?>
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
<?php include 'includes/footer.php'; ?>
