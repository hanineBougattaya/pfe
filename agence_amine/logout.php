<?php
session_start(); // Démarre la session

// Détruit toutes les données de la session
session_unset();
session_destroy();

// Redirige vers la page de connexion
header('Location: home.php');
exit;
?>