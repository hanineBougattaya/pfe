<?php
session_start();
include 'db.php'; // Connexion à la base de données

// Récupérer les données du formulaire
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Préparer la requête SQL pour insérer le message dans la base de données
$query = $pdo->prepare("INSERT INTO messages (name, email, message, date) VALUES (?, ?, ?, NOW())");
$query->execute([$name, $email, $message]);

// Rediriger vers la page de contact avec un message de succès
header('Location: contact.php?success=1');
exit;
?>
