<?php 
// Démarrer la session
session_start();

$title = "Connexion";
include 'includes/header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Vérification statique du login et mot de passe (à remplacer par une vérification réelle)
    if ($login === 'hanine1' && $password === '1234') {
        // Création de la session pour l'utilisateur
        $_SESSION['user_id'] = 1; // ID arbitraire de l'utilisateur
        $_SESSION['role'] = 'admin'; // Rôle défini manuellement
        
        // Redirection vers la page dashboard après connexion réussie
        header('Location: dashboard.php');
        exit; // Terminer le script après redirection
    } else {
        // Message d'erreur si les identifiants sont incorrects
        $error = "Login ou mot de passe incorrect.";
    }
}
?>

<div class="container">
    <div class="login">
        <h2>Connexion</h2>
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        <form method="POST">
            <label for="login">Login :</label>
            <input type="text" name="login" required>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
