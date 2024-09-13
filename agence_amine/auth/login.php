<?php
$title = "Connexion"; 
include '../includes/header.php'; 
include '../config/db.php'; // Connexion à la base de données
include '../includes/navbar.php'; // Navigation principale

// Initialiser les variables
$error = "";

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    // Vérification statique des identifiants pour l'admin
    if ($login === 'hanine1' && $password === '1234') {
        // Création de la session pour l'utilisateur
        $_SESSION['user_id'] = 1; // ID arbitraire de l'admin
        $_SESSION['role'] = 'admin'; // Rôle admin
        
        // Redirection vers la page dashboard après connexion réussie
        header('Location: /dashboard.php');
        exit; // Terminer le script après redirection
    } else {
        // Vérification dans la base de données pour les apprenants
        $stmt = $pdo->prepare("SELECT * FROM apprenant WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            // Vérification dans la base de données pour les moniteurs si l'utilisateur n'est pas un apprenant
            $stmt = $pdo->prepare("SELECT * FROM moniteur WHERE login = ?");
            $stmt->execute([$login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($password, $user['password'])) {
                // Message d'erreur si les identifiants sont incorrects
                $error = "Login ou mot de passe incorrect.";
            } else {
                // Création de la session pour le moniteur
                $_SESSION['user_id'] = $user['ID_MONITEUR']; // ID du moniteur
                $_SESSION['role'] = 'moniteur'; // Rôle
                
                // Redirection vers la page dashboard après connexion réussie
                header('Location: /dashboard.php');
                exit; // Terminer le script après redirection
            }
        } else {
            // Création de la session pour l'apprenant
            $_SESSION['user_id'] = $user['ID_APPRENANT']; // ID de l'apprenant
            $_SESSION['role'] = 'apprenant'; // Rôle
            
            // Redirection vers la page dashboard après connexion réussie
            header('Location: /dashboard.php');
            exit; // Terminer le script après redirection
        }
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
                
                <button type="submit" class="btn btn-primary">Se Connecter</button>
            </form>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
