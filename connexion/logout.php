<?php
// Démarrer la session
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion (ou toute autre page que vous souhaitez après la déconnexion)
header("Location: connexion.php");
exit(); // Assure que le script s'arrête après la redirection
?>
