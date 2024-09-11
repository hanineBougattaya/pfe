<?php
$title = "Contact - Auto École";
include 'includes/header.php'; 
include 'config/db.php';
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
<?php include 'includes/footer.php'; ?>