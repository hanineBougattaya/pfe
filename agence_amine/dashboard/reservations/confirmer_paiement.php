<?php
include '../../includes/header.php'; 
include '../../config/db.php';
include '../../includes/navbar.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    try {
        $query = $pdo->prepare("UPDATE reservation SET STATUT_PAIEMENT = 'Payé' WHERE ID_RESERVATION = ?");
        $query->execute([$reservation_id]);
        header('Location: /dashboard/reservations.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur lors de la confirmation du paiement: " . $e->getMessage();
    }
} else {
    echo "ID de réservation non fourni.";
}
?>
