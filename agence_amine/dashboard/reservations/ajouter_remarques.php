<?php
include '../../includes/header.php'; 
include '../../config/db.php';
include '../../includes/navbar.php'; 

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

$id_reservation = $_GET['id'] ?? null;
if (!$id_reservation) {
    header('Location: reservations.php'); // Redirige si aucun ID n'est fourni
    exit;
}

// Récupérer les remarques existantes si le formulaire est affiché
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = $pdo->prepare("SELECT REMARQUES FROM reservation WHERE ID_RESERVATION = ?");
    $query->execute([$id_reservation]);
    $reservation = $query->fetch(PDO::FETCH_ASSOC);
    $remarques = $reservation['REMARQUES'] ?? '';
}

// Mettre à jour les remarques si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_remarques = $_POST['remarques'] ?? '';
    $query = $pdo->prepare("UPDATE reservation SET REMARQUES = ? WHERE ID_RESERVATION = ?");
    $query->execute([$new_remarques, $id_reservation]);
    header('Location: /dashboard/reservations.php'); // Redirection après mise à jour
    exit;
}
?>

<header class="text-center">
    <h1>Ajouter/Modifier Remarques</h1>
    <a href="/dashboard/reservations.php" class="btn btn-light">Retour à la liste des réservations</a>

</header>

<main class="container my-5">
    <form method="POST">
        <div class="form-group">
            <label for="remarques">Remarques :</label>
            <textarea name="remarques" id="remarques" class="form-control" rows="4" required><?= htmlspecialchars($remarques); ?></textarea>
        </div>
        <button type="submit" class="btn btn-warning text-white ">Enregistrer</button>
        <a href="reservations.php" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php include '../../includes/footer.php'; ?>
