<?php
$title = "Modifier Moniteur"; 
include 'includes/header.php'; 
session_start();
include 'config/db.php';

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Vérification si un ID moniteur est passé dans l'URL
if (!isset($_GET['id'])) {
    header('Location: moniteurs.php');
    exit;
}

$id = $_GET['id'];

// Récupération des informations du moniteur
$query = $pdo->prepare("SELECT * FROM moniteur WHERE ID_MONITEUR = ?");
$query->execute([$id]);
$moniteur = $query->fetch(PDO::FETCH_ASSOC); // Récupération sous forme associative

if (!$moniteur) {
    // Si aucun moniteur trouvé, redirection
    header('Location: moniteurs.php');
    exit;
}

// Message de résultat
$message = "";

// Traitement du formulaire pour la mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des nouvelles données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $login = $_POST['login'];

    // Comparer les données du formulaire avec les données actuelles
    $modifications = [];
    if ($nom != ($moniteur['Nom'] ?? '')) $modifications[] = 'nom';
    if ($prenom != ($moniteur['Prenom'] ?? '')) $modifications[] = 'prenom';
    if ($date_naissance != ($moniteur['Date_Naissance'] ?? '')) $modifications[] = 'date de naissance';
    if ($adresse != ($moniteur['Adresse'] ?? '')) $modifications[] = 'adresse';
    if ($telephone != ($moniteur['Telephone'] ?? '')) $modifications[] = 'téléphone';
    if ($email != ($moniteur['Email'] ?? '')) $modifications[] = 'email';
    if ($login != ($moniteur['Login'] ?? '')) $modifications[] = 'login';

    // Si un nouveau mot de passe est saisi, on le considère comme une modification
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $modifications[] = 'mot de passe';
    }

    // Si aucune modification n'est détectée
    if (empty($modifications)) {
        $message = "Aucune modification n'a été effectuée.";
    } else {
        // Mettre à jour les données
        if (!empty($_POST['password'])) {
            $query = $pdo->prepare("UPDATE moniteur SET Nom = ?, Prenom = ?, Date_Naissance = ?, Adresse = ?, Telephone = ?, Email = ?, Login = ?, Password = ? WHERE ID_MONITEUR = ?");
            $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $password, $id]);
        } else {
            $query = $pdo->prepare("UPDATE moniteur SET Nom = ?, Prenom = ?, Date_Naissance = ?, Adresse = ?, Telephone = ?, Email = ?, Login = ? WHERE ID_MONITEUR = ?");
            $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $id]);
        }
        
        $message = "Modifications effectuées avec succès pour les champs : " . implode(', ', $modifications) . ".";
    }
}
?>
<?php include 'includes/navbar.php'; ?>

<header>
    <h1>Modifier le Moniteur</h1>
    <a href="moniteurs.php" class="btn btn-light">Retour à la liste des moniteurs</a>
</header>
<div class="container">
    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($moniteur['Nom'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($moniteur['Prenom'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de Naissance :</label>
            <input type="date" name="date_naissance" value="<?= htmlspecialchars($moniteur['Date_Naissance'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" value="<?= htmlspecialchars($moniteur['Adresse'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone" value="<?= htmlspecialchars($moniteur['Telephone'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" value="<?= htmlspecialchars($moniteur['Email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="login">Login :</label>
            <input type="text" name="login" value="<?= htmlspecialchars($moniteur['Login'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Nouveau Mot de Passe (laisser vide pour ne pas changer) :</label>
            <input type="password" name="password">
        </div>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>