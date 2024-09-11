<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Vérification statique du login et mot de passe
    if ($login === 'hanine1' && $password === '1234') {
        // Création de la session pour l'utilisateur
        $_SESSION['user_id'] = 1; // On peut mettre un ID arbitraire
        $_SESSION['role'] = 'admin'; // Rôle défini manuellement
        header('Location: dashboard.php');
        exit; // Terminer le script après redirection
    } else {
        $error = "Login ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        <label for="login">Login :</label>
        <input type="text" name="login" required>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
