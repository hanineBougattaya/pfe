<?php
session_start();
include '../../config/db.php';

// Vérification si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

// Récupérer l'ID de la réservation
$id_reservation = $_GET['id'] ?? null;

if ($id_reservation) {
    // Mettre à jour la réservation pour indiquer qu'elle a été acceptée
    $query = $pdo->prepare("UPDATE reservation SET STATUT = 'acceptée' WHERE ID_RESERVATION = ?");
    $query->execute([$id_reservation]);
}

header('Location: /dashboard.php'); // Redirection après traitement
exit;
?>
