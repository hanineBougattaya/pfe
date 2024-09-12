<?php
// Déclarations initiales et inclusions
$title = "Modifier Apprenant";
include '../../includes/header.php'; 
include '../../includes/navbar.php'; 
include '../../config/db.php'; // Connexion à la base de données

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Vérification si un ID apprenant est passé dans l'URL
if (!isset($_GET['id'])) {
    header('Location: /dashboard/apprenants.php');
    exit;
}

$id = $_GET['id'];

// Récupération des informations de l'apprenant
$query = $pdo->prepare("SELECT * FROM apprenant WHERE ID_APPRENANT = ?");
$query->execute([$id]);
$apprenant = $query->fetch(PDO::FETCH_ASSOC);

if (!$apprenant) {
    // Si aucun apprenant trouvé, redirection
    header('Location: /dashboard/apprenants.php');
    exit;
}

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
    $modifications = [];

    // Comparaison des nouvelles données avec les anciennes
    if ($nom != ($apprenant['Nom'] ?? '')) $modifications[] = 'nom';
    if ($prenom != ($apprenant['prenom'] ?? '')) $modifications[] = 'prénom';
    if ($date_naissance != ($apprenant['DATE_NAISSANCE'] ?? '')) $modifications[] = 'date de naissance';
    if ($adresse != ($apprenant['ADRESSE'] ?? '')) $modifications[] = 'adresse';
    if ($telephone != ($apprenant['TELEPHONE'] ?? '')) $modifications[] = 'téléphone';
    if ($email != ($apprenant['EMAIL'] ?? '')) $modifications[] = 'email';
    if ($login != ($apprenant['login'] ?? '')) $modifications[] = 'login';

    // Vérification et traitement du mot de passe
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $modifications[] = 'mot de passe';
    }

    // Vérification des modifications et mise à jour
    if (empty($modifications)) {
        $message = "Aucune modification n'a été effectuée.";
    } else {
        // Préparation de la requête SQL avec ou sans mot de passe
        if (!empty($_POST['password'])) {
            $query = $pdo->prepare("UPDATE apprenant SET Nom = ?, prenom = ?, DATE_NAISSANCE = ?, ADRESSE = ?, TELEPHONE = ?, EMAIL = ?, login = ?, password = ? WHERE ID_APPRENANT = ?");
            $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $password, $id]);
        } else {
            $query = $pdo->prepare("UPDATE apprenant SET Nom = ?, prenom = ?, DATE_NAISSANCE = ?, ADRESSE = ?, TELEPHONE = ?, EMAIL = ?, login = ? WHERE ID_APPRENANT = ?");
            $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $id]);
        }
        
        $message = "Modifications effectuées avec succès pour les champs : " . implode(', ', $modifications) . ".";
    }
}
?>

<header class="text-center">
    <h1 class="display-4">Modifier l'Apprenant</h1>
    <a href="/dashboard/apprenants.php" class="btn btn-light">Retour à la liste des apprenants</a>
</header>

<main class="container my-5">
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="POST" class="mx-auto row" style="max-width: 50%;">
        <div class="form-group col-12 mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($apprenant['Nom'] ?? '') ?>" required>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($apprenant['prenom'] ?? '') ?>" required>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="date_naissance" class="form-label">Date de Naissance :</label>
            <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="<?= htmlspecialchars($apprenant['DATE_NAISSANCE'] ?? '') ?>" required>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="adresse" class="form-label">Adresse :</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="<?= htmlspecialchars($apprenant['ADRESSE'] ?? '') ?>" required>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="telephone" class="form-label">Téléphone :</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="<?= htmlspecialchars($apprenant['TELEPHONE'] ?? '') ?>" required>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($apprenant['EMAIL'] ?? '') ?>" required>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="login" class="form-label">Login :</label>
            <input type="text" name="login" id="login" class="form-control" value="<?= htmlspecialchars($apprenant['login'] ?? '') ?>" required>
        </div>
        <div class="form-group col-12 mb-4">
            <label for="password" class="form-label">Nouveau Mot de Passe (laisser vide pour ne pas changer) :</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100">Enregistrer les modifications</button>
    </form>
    </main>


<?php include '../../includes/footer.php'; ?>
