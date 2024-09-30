<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    include('../script/variablesBdd.php');
    include('../script/variablesTable.php');

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données : " . $connexion->connect_error);
    }

    // Utilisation de MD5 pour le mot de passe
    // $hashed_password = md5($password);

    // Prévenir les injections SQL en utilisant des requêtes préparées
    $stmt = $connexion->prepare("SELECT * FROM $Table_Utilisateur WHERE BINARY login = ? AND BINARY MDP = ?");
    $stmt->bind_param("ss", $username, $password);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer le résultat
    $resultat = $stmt->get_result();

    // Vérifier si l'utilisateur existe
    if ($resultat->num_rows > 0) {
        // L'utilisateur est authentifié avec succès
        while ($row = $resultat->fetch_assoc()) {
            // Vous pouvez accéder aux colonnes de la base de données ici
            $userID = $row["id"];
            $isAdmin = $row["ADMIN"];
            $Avatar = $row["avatar"];
            $Theme = $row["theme"];

            // Démarrer une session
            session_start();

            // Stocker les informations dans la session
            $_SESSION['userID'] = $userID;
            $_SESSION['username'] = $username;
            $_SESSION['isAdmin'] = $isAdmin;
            $_SESSION['Avatar'] = $Avatar;
            $_SESSION['Theme'] = $Theme;

            // Redirection vers ../index.php
            header("Location: ../tableau-bord/tableau-bord.php?profil=potager");
            exit(); // Assure que le script s'arrête après la redirection
        }
    } else {
        // Identifiants incorrects
        echo "Identifiants incorrects";
        
        // Démarrer une session
        session_start();

        // Stocker les informations dans la session
        $_SESSION['erreur-login'] = 'Le nom d\'utilisateur et/ou le mot de passe est incorrect !';

        // Pause de 3 secondes
        sleep(3);

        // Redirection vers ../index.php
        header("Location: connexion.php");
        exit(); // Assure que le script s'arrête après la redirection
    }

    // Fermer la connexion
    $stmt->close();
    $connexion->close();
}
?>
