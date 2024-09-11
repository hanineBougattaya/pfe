<?php
// Inclure le fichier de connexion à la base de données
include 'db.php'; 

// Initialiser les variables
$message_sent = false;

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Préparer la requête d'insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO messages (name, email, message, date) VALUES (:name, :email, :message, NOW())");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    
    if ($stmt->execute()) {
        $message_sent = true;
    } else {
        $message_sent = false;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Auto École</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            padding: 40px 20px;
        }
        .container h1 {
            color: #333;
            margin-bottom: 30px;
        }
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-form label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }
        .contact-form button {
            background-color: #ffc107;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #e0a800;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Contactez-Nous</h1>
        <?php if ($message_sent): ?>
            <div class="alert alert-success" role="alert">
                Votre message a été envoyé avec succès ! Nous vous contacterons dès que possible.
            </div>
        <?php else: ?>
            <form class="contact-form" action="contact.php" method="POST">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                
                <button type="submit">Envoyer</button>
            </form>
        <?php endif; ?>
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
