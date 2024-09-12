<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #333; padding: 0; margin : 0;">
    <a class="navbar-brand text-light" href="#" style="padding-left: 20px;">Auto École Ahmed</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar" style="margin: 0; width : 80%;" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="/services.php">NOS SERVICES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/about.php">À PROPOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/contact.php">CONTACT</a>
            </li>
        </ul>
        <ul class="navbar-nav" style="margin: 2px;">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item " style="margin: 5px;">
                    <a class="nav-link text-light" href="/dashboard.php"><i class="fas fa-tachometer-alt"></i> DASHBOARD</a>
                </li>
                <li class="nav-item" style="margin: 5px;">
                    <a class="nav-link text-light" href="/auth/logout.php"><i class="fas fa-sign-out-alt"></i> DÉCONNEXION</a>
                </li>
            <?php else: ?>
                <li class="nav-item" style="margin: 5px;">>
                    <a class="nav-link text-light" href="/auth/login.php"><i class="fas fa-user"></i> CONNEXION</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
