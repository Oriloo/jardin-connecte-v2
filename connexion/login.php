<?php
// Activer l'affichage des erreurs pour le débogage (à désactiver en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrer la session en début de script
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et nettoyer les données du formulaire
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';

    // Vérifier que les champs ne sont pas vides
    if (empty($username) || empty($password)) {
        $_SESSION['erreur-login'] = 'Veuillez remplir tous les champs.';
        header("Location: connexion.php");
        exit();
    }

    // Inclure les fichiers de configuration de la base de données et des tables
    include('../script/variablesBdd.php');
    include('../script/variablesTable.php');

    // Vérifier que les variables nécessaires sont définies
    if (!isset($serveur, $utilisateur, $motDePasse, $nomBdd, $Table_Utilisateur)) {
        error_log("Variables de configuration manquantes.");
        $_SESSION['erreur-login'] = 'Erreur de configuration.';
        header("Location: connexion.php");
        exit();
    }

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        // Log l'erreur et redirige avec un message générique
        error_log("Échec de la connexion à la base de données : " . $connexion->connect_error);
        $_SESSION['erreur-login'] = 'Erreur de connexion à la base de données.';
        header("Location: connexion.php");
        exit();
    }

    // Définir le jeu de caractères
    if (!$connexion->set_charset("utf8mb4")) {
        error_log("Erreur lors de la définition du jeu de caractères utf8mb4 : " . $connexion->error);
        $_SESSION['erreur-login'] = 'Erreur de configuration.';
        header("Location: connexion.php");
        exit();
    }

    // Hacher le mot de passe avec MD5
    $hashed_password = md5($password);

    // Préparer la requête SQL pour éviter les injections SQL
    $stmt = $connexion->prepare("SELECT `id`, `ADMIN`, `avatar`, `theme` FROM `$Table_Utilisateur` WHERE BINARY `login` = ? AND BINARY `MDP` = ?");
    if (!$stmt) {
        error_log("Erreur de préparation de la requête : " . $connexion->error);
        $_SESSION['erreur-login'] = 'Erreur de connexion.';
        header("Location: connexion.php");
        exit();
    }

    // Lier les paramètres (login et mot de passe haché)
    $stmt->bind_param("ss", $username, $hashed_password);

    // Exécuter la requête
    if (!$stmt->execute()) {
        error_log("Erreur d'exécution de la requête : " . $stmt->error);
        $_SESSION['erreur-login'] = 'Erreur de connexion.';
        header("Location: connexion.php");
        exit();
    }

    // Lier les résultats
    $stmt->bind_result($id, $admin, $avatar, $theme);

    // Vérifier si un utilisateur correspond
    if ($stmt->fetch()) {
        // Authentification réussie
        $_SESSION['userID'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['isAdmin'] = $admin;
        $_SESSION['Avatar'] = $avatar;
        $_SESSION['Theme'] = $theme;

        // Fermer la requête et la connexion avant la redirection
        $stmt->close();
        $connexion->close();

        // Redirection vers le tableau de bord
        header("Location: ../tableau-bord/?profil=potager");
        exit(); // Assure que le script s'arrête après la redirection
    } else {
        // Identifiants incorrects

        // Fermer la requête et la connexion
        $stmt->close();
        $connexion->close();

        // Délai de 2 secondes avant de rediriger
        sleep(2);

        // Stocker le message d'erreur dans la session
        $_SESSION['erreur-login'] = 'Le nom d\'utilisateur et/ou le mot de passe est incorrect !';

        // Redirection vers la page de connexion
        header("Location: connexion.php");
        exit(); // Assure que le script s'arrête après la redirection
    }
}
?>
