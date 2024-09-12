<?php
$title = "Ajouter Moniteur"; 
include '../../includes/header.php'; 
include '../../includes/navbar.php'; 
include '../../config/db.php';

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

// Message de résultat
$message = "";
$errors = [];

// Traitement du formulaire pour l'ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $date_naissance = $_POST['date_naissance'];
    $adresse = trim($_POST['adresse']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $date_embauche = $_POST['date_embauche'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validation des champs
    if (!preg_match("/^[a-zA-Z\s]+$/", $nom)) {
        $errors[] = "Le nom doit contenir uniquement des lettres et des espaces.";
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $prenom)) {
        $errors[] = "Le prénom doit contenir uniquement des lettres et des espaces.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse e-mail n'est pas valide.";
    }

    if (!preg_match("/^\d{8}$/", $telephone)) {
        $errors[] = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
    }

    if (empty($errors)) {
        // Requête pour insérer un moniteur
        $query = $pdo->prepare("INSERT INTO moniteur (Nom, Prenom, Date_Naissance, Adresse, Telephone, Email, Login, Date_Embauche, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $date_embauche, $password]);

        $message = "Moniteur ajouté avec succès.";
    }
}
?>
<header class="text-center">
    <h1 class="display-4">Ajouter un Moniteur</h1>
    <a href="/dashboard/moniteurs.php" class="btn btn-light">Retour à la liste des moniteurs</a>
</header>
<main class="container my-5">
    <?php if ($message): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="card shadow-lg">
        <div class="card-body">
            <form method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" required>
                    </div>
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
                    <label for="date_embauche">Date d'Embauche :</label>
                    <input type="date" name="date_embauche" id="date_embauche" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe :</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Ajouter Moniteur</button>
            </form>
        </div>
    </div>
</main>
<?php include '../../includes/footer.php'; ?>
