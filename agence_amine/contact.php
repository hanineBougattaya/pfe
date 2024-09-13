<?php
$title = "Contact - Auto École";
include 'includes/header.php'; 
include 'config/db.php';
include 'includes/navbar.php'; 

// Initialiser les variables
$message_sent = false;

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
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

<header class="text-center mb-4">
    <h1 class="section-title">Nous Contacter</h1>
    <p>Nous vous répondrons dans les plus brefs délais.</p>
</header>

<main class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <?php if ($message_sent): ?>
                <div class="alert alert-success" role="alert">
                    Votre message a été envoyé avec succès ! Nous vous contacterons dès que possible.
                </div>
            <?php else: ?>
                <form class="contact-form" action="contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" id="name" name="name" class="form-control form-control-lg" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message :</label>
                        <textarea id="message" name="message" class="form-control form-control-lg" rows="6" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-warning text-white  btn-lg">Envoyer</button>
                </form>
            <?php endif; ?>
            <div class="text-center mt-4">
                <a href="reserver_cours.php" class="btn btn-warning text-white  btn-lg">Réserver votre premier cours</a>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
