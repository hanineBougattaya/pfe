<?php
// Définir le titre du header et l'élément actif du menu
$title = 'Tableau de Bord'; // Titre du header, valeur par défaut "Tableau de Bord"
$activePage = isset($activePage) ? $activePage : ''; // Page active, valeur par défaut vide

// Liste des pages pour la navigation
$navItems = [
    '/dashboard/apprenants.php' => 'Gérer les Apprenants',
    '/dashboard/moniteurs.php' => 'Gérer les Moniteurs',
    '/dashboard/vehicules.php' => 'Gérer les motos',
    '/dashboard/reservations.php' => 'Gérer les Réservations',
    '/dashboard/contact_messages.php' => 'Messages de Contact'
];
?>

<header class="text-center py-4">
    <h1 class="display-3 mb-4"><?php echo htmlspecialchars($title); ?></h1>
    <nav>
        <ul class="nav nav-pills justify-content-center">
            <?php foreach ($navItems as $url => $label): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($url === $activePage) ? 'active text-black' : ''; ?>" href="<?php echo htmlspecialchars($url); ?>">
                        <?php echo htmlspecialchars($label); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

