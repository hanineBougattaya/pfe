<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Auto École</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Ajout de Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #495057;
        }
        .navbar .navbar-nav .nav-item:last-child {
            margin-left: auto;
        }
        .hero {
            background-color: #ffc107;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.25rem;
        }
        .container {
            padding: 40px 20px;
        }
        .section-title {
            margin-bottom: 30px;
            font-size: 2rem;
            color: #343a40;
        }
        .section-content {
            margin-bottom: 30px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .reservation-form {
            margin-top: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Auto École</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Nos Services</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">À Propos</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fas fa-user"></i> Connexion </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="hero">
        <h1>Bienvenue chez Auto École</h1>
        <p>Découvrez nos services de formation et passez votre permis avec les meilleurs.</p>
        <a href="services.php" class="btn btn-light btn-lg">Nos Services</a>
    </div>

    <div class="container">
        <h2 class="section-title">Nos Services</h2>
        <div class="section-content">
            <p>Nous offrons une gamme complète de services pour vous aider à réussir votre permis de conduire :</p>
            <ul>
                <li>Formation théorique et pratique</li>
                <li>Leçons personnalisées</li>
                <li>Évaluations régulières</li>
                <li>Assistance pour les examens</li>
            </ul>
        </div>

        <h2 class="section-title">À Propos de Nous</h2>
        <div class="section-content">
            <p>Auto École est dédiée à fournir une formation de qualité pour vous aider à atteindre vos objectifs de conduite. Notre équipe d'instructeurs expérimentés est là pour vous guider à chaque étape du processus.</p>
        </div>

        <h2 class="section-title">Réservez Votre Cours</h2>
       
        <a href="reserver_cours.php" class="btn btn-primary">Réserver</a>

            </form>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Auto École. Tous droits réservés.</p>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
