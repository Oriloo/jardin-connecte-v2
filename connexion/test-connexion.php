<?php
// Démarrez la session (assurez-vous de l'avoir démarrée avant tout affichage de contenu)
session_start();

// Vérifiez si les informations de session existent
if (isset($_SESSION['userID']) && 
    isset($_SESSION['Avatar']) && 
    isset($_SESSION['username']) && 
    isset($_SESSION['isAdmin']) && 
    isset($_SESSION['Theme'])) {

    // Les informations de session existent, vous pouvez les utiliser
    $UserID = $_SESSION['userID'];
    $UserName = $_SESSION['username'];
    $isAdmin = $_SESSION['isAdmin'];
    $Avatar = $_SESSION['Avatar'];
    $Theme = $_SESSION['Theme'];
    
} else {
    // Les informations de session n'existent pas, rediriger vers la page de connexion
    header("Location: ../connexion/connexion.php");
    exit(); // Assure que le script s'arrête après la redirection
}
?>
