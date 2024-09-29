<?php
// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Requête SQL pour récupérer les valeurs des colonnes "id" et "login" de la table "utilisateur"
$sql = "SELECT id, login FROM $Table_Utilisateur";

// Exécution de la requête
$resultat = $connexion->query($sql);

// Création d'un tableau associatif pour stocker les logins associés à leurs IDs
$loginById = array();
if ($resultat->num_rows > 0) {
    while ($ligne = $resultat->fetch_assoc()) {
        $loginById[$ligne["id"]] = $ligne["login"];
    }
} else {
    echo "Aucun résultat trouvé.";
}

// Fermer la connexion
$connexion->close();
?>
