<?php
$title = "Connexion"; 
include '../includes/header.php'; 
include '../config/db.php'; // Connexion à la base de données si nécessaire
include '../includes/navbar.php'; // Navigation principale

// Initialiser les variables
$error = "";

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    // Vérification statique des identifiants pour l'admin
    if ($login === 'hanine1' && $password === '1234') {
        // Création de la session pour l'admin
        session_start(); // Assurez-vous que les sessions sont bien démarrées
        $_SESSION['user_id'] = 1; // ID arbitraire de l'admin
        $_SESSION['role'] = 'admin'; // Rôle admin
        
        // Redirection vers la page dashboard après connexion réussie
        header('Location: /dashboard.php');
        exit; // Terminer le script après redirection
    } else {
        // Si les identifiants sont incorrects
        $error = "Login ou mot de passe incorrect.";
    }
}
?>

<header class="text-center mb-4">
    <h1>Connexion</h1>
</header>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="POST" class="form-signin">
                <div class="form-group">
                    <label for="login">Login :</label>
                    <input type="text" id="login" name="login" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de Passe :</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-warning text-white ">Se Connecter</button>
            </form>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
