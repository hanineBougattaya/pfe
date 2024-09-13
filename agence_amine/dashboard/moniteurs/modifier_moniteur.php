<?php
$title = "Modifier Moniteur"; 
include '../../includes/header.php'; 
include '../../config/db.php';
include '../../includes/navbar.php'; 

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

// Vérification si un ID moniteur est passé dans l'URL
if (!isset($_GET['id'])) {
    header('Location: /dashboard/moniteurs.php');
    exit;
}

$id = $_GET['id'];

// Récupération des informations du moniteur
$query = $pdo->prepare("SELECT * FROM moniteur WHERE ID_MONITEUR = ?");
$query->execute([$id]);
$moniteur = $query->fetch(PDO::FETCH_ASSOC);

if (!$moniteur) {
    header('Location: /dashboard/moniteurs.php');
    exit;
}

// Message de résultat
$message = "";
$errors = [];

// Traitement du formulaire pour la mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des nouvelles données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $date_naissance = $_POST['date_naissance'];
    $adresse = trim($_POST['adresse']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

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
        // Comparer les données du formulaire avec les données actuelles
        $modifications = [];
        if ($nom != ($moniteur['Nom'] ?? '')) $modifications[] = 'nom';
        if ($prenom != ($moniteur['Prenom'] ?? '')) $modifications[] = 'prénom';
        if ($date_naissance != ($moniteur['Date_Naissance'] ?? '')) $modifications[] = 'date de naissance';
        if ($adresse != ($moniteur['Adresse'] ?? '')) $modifications[] = 'adresse';
        if ($telephone != ($moniteur['Telephone'] ?? '')) $modifications[] = 'téléphone';
        if ($email != ($moniteur['Email'] ?? '')) $modifications[] = 'email';
        if ($login != ($moniteur['Login'] ?? '')) $modifications[] = 'login';

        // Préparer la requête de mise à jour
        if (!empty($modifications)) {
            $sql = "UPDATE moniteur SET Nom = ?, Prenom = ?, Date_Naissance = ?, Adresse = ?, Telephone = ?, Email = ?, Login = ?";
            $params = [$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $login];

            // Ajouter la colonne Password à la mise à jour si un nouveau mot de passe est fourni
            if ($password) {
                $sql .= ", Password = ?";
                $params[] = $password;
            }

            $sql .= " WHERE ID_MONITEUR = ?";
            $params[] = $id;

            $query = $pdo->prepare($sql);
            $query->execute($params);
            
            $message = "Modifications effectuées avec succès pour les champs : " . implode(', ', $modifications) . ".";
        } else {
            $message = "Aucune modification n'a été effectuée.";
        }
    }
}
?>

<header class="text-center mb-4">
    <h1 class="display-4">Modifier le Moniteur</h1>
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
                        <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($moniteur['Nom'] ?? '') ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" value="<?= htmlspecialchars($moniteur['Prenom'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_naissance">Date de Naissance :</label>
                    <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="<?= htmlspecialchars($moniteur['Date_Naissance'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse :</label>
                    <input type="text" name="adresse" id="adresse" class="form-control" value="<?= htmlspecialchars($moniteur['Adresse'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone :</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" value="<?= htmlspecialchars($moniteur['Telephone'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($moniteur['Email'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="login">Login :</label>
                    <input type="text" name="login" id="login" class="form-control" value="<?= htmlspecialchars($moniteur['Login'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Nouveau Mot de Passe (laisser vide pour ne pas changer) :</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</main>
<?php include '../../includes/footer.php'; ?>
