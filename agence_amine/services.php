<?php
$title = "Services";
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/db.php'; // Assure-toi que ce fichier contient la connexion à la base de données

// Récupérer les services depuis la base de données
$query = $pdo->query("SELECT * FROM service_moto");
$services = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<header class="text-center mb-4">
    <h1 class="section-title text-center mb-4">Nos Services</h1>
    <p>Découvrez nos services de formation et passez votre permis avec les meilleurs.</p>
</header>
<main class="container">
    <div class="text-center mb-4">
        <p>Auto École est dédiée à fournir une formation de qualité pour vous aider à atteindre vos objectifs de conduite. Notre équipe d'instructeurs expérimentés est là pour vous guider à chaque étape du processus.</p>
    </div>
    <div class="row">
        <?php foreach ($services as $service) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($service['Type_moto']); ?></h5>
                        <p class="card-text">
                            <strong>Marque :</strong> <?= htmlspecialchars($service['Marque']); ?><br>
                            <strong>Modèle :</strong> <?= htmlspecialchars($service['Modele']); ?><br>
                            <strong>Immatriculation :</strong> <?= htmlspecialchars($service['Immatriculation']); ?><br>
                            <strong>Prix :</strong> <?= htmlspecialchars($service['Prix']); ?> DT
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <h2 class="section-title text-center mb-4">Réservez Votre Cours</h2>
    <div class="text-center">
        <a href="reserver_cours.php" class="btn btn-primary mb-4">Réserver votre premier cours</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
