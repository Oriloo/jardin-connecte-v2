<?php
// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$sql = "SELECT * FROM $Table_ToleranceS";
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Handle the query error
    die("Error executing SQL query: " . $connexion->error);
}

// Les valeurs de la table declencher_seuils
$date_t = [];
$time_t = [];
$user_t = [];
$tole_t = [];
// Stocker les données dans des tableaux
while ($row = $resultat->fetch_assoc()) {
    $date_t[] = $row['date'];
    $time_t[] = $row['time'];
    $user_t[] = $row['modif_par'];
    $tole_t[] = $row['tolerance'];
}

// Récupérer la dernière valeur de chaque tableau
$last_tole_t = end($tole_t);

$connexion->close();
?>
