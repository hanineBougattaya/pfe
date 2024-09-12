<?php
$title = "Ajouter un Apprenant"; 
include '../../includes/header.php'; 
include '../../config/db.php';
include '../../includes/navbar.php'; 

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $date_naissance = $_POST['date_naissance'];
    $adresse = trim($_POST['adresse']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validation des champs
    if (!preg_match("/^[a-zA-Z\s]+$/", $nom)) {
        $errors[] = "Le nom doit contenir uniquement des lettres et des espaces.";
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $prenom)) {
        $errors[] = "Le prénom doit contenir uniquement des lettres et des espaces.";
    }

    if (!preg_match("/^\d{8}$/", $telephone)) {
        $errors[] = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse e-mail n'est pas valide.";
    }

    // Vérification s'il n'y a pas d'erreurs avant l'insertion
    if (empty($errors)) {
        // Requête pour insérer un nouvel apprenant
        $query = $pdo->prepare("INSERT INTO apprenant (Nom, Prenom, DATE_NAISSANCE, ADRESSE, TELEPHONE, EMAIL, login, password, Date_Inscription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login, $password, date('Y-m-d')]);

        header('Location: /dashboard/apprenants.php');
        exit;
    }
}
?>
<header class="text-center">
    <h1 class="display-4">Ajouter un Apprenant</h1>
    <a href="/dashboard/apprenants.php" class="btn btn-light">Retour à la liste des apprenants</a>
</header>
<main class="background-cover" style="
    background: url('../../assets/images/image1.jpg') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nom" class="form-label">Nom :</label>
                                    <input type="text" name="nom" id="nom" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prenom" class="form-label">Prénom :</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_naissance" class="form-label">Date de Naissance :</label>
                                <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="adresse" class="form-label">Adresse :</label>
                                <input type="text" name="adresse" id="adresse" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone" class="form-label">Téléphone :</label>
                                <input type="text" name="telephone" id="telephone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="login" class="form-label">Login :</label>
                                <input type="text" name="login" id="login" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Mot de Passe :</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include '../../includes/footer.php'; ?>
