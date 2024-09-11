<?php
// Informations de connexion à la base de données
$host = '127.0.0.1';   // ou 'localhost'
$db   = 'agence_ahmed'; // Remplacez par le nom de votre base de données
$user = 'root';        // Utilisateur MySQL
$pass = '';            // Mot de passe MySQL (si aucun, laissez vide)
$charset = 'utf8mb4';  // Jeu de caractères

// Configuration de l'objet PDO pour la connexion
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Affichage d'un message d'erreur en cas de problème de connexion
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
