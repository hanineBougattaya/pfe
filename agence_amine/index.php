<?php
// Page d'accueil de l'application
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Auto-école</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenue à l'Auto-école</h1>
        <nav>
            <ul>
                <li><a href="login.php">Connexion</a></li>
                <li><a href="apprenants.php">Gérer les Apprenants</a></li>
                <li><a href="moniteurs.php">Gérer les Moniteurs</a></li>
                <li><a href="vehicules.php">Gérer les Véhicules</a></li>
                <li><a href="reservations.php">Gérer les Réservations</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Gérez facilement vos apprenants, moniteurs, véhicules et réservations à partir de ce tableau de bord.</p>
    </main>
</body>
</html>
