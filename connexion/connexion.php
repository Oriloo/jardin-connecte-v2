<?php
// Démarrez la session (assurez-vous de l'avoir démarrée avant tout affichage de contenu)
session_start();

// Vérifiez si les informations de session existent
if(isset($_SESSION['erreur-login'])) {
    // Les informations de session existent, vous pouvez les utiliser
    $erreur = $_SESSION['erreur-login'];
} else {
    $erreur = '';
}

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/svg/logo-jc.svg" />
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="s-connexion.css">
</head>
<body>
    <?php include('../script/variablesStyle.php'); ?>
    <nav> <img class="logo-jc" src="../image/svg/logo-jc-nom.svg" /> </nav>

    <div class="login-container">
        <h2>Connexion</h2>
        <form action="login.php" method="post">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se Connecter</button>
        </form>
    </div>
    <div class="login-erreur">
        <?php echo $erreur; ?>
    </div>
</body>
</html>
