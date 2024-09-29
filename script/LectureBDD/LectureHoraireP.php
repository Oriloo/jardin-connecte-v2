<?php
// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$sql = "SELECT * FROM $Table_ArrosageH";
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Handle the query error
    die("Error executing SQL query: " . $connexion->error);
}

// Les valeurs de la table declencher_seuils
$date_h = [];
$time_h = [];
$user_h = [];
$minh_h = [];
$maxh_h = [];
// Stocker les données dans des tableaux
while ($row = $resultat->fetch_assoc()) {
    $date_d[] = $row['date'];
    $time_d[] = $row['time'];
    $user_d[] = $row['modif_par'];
    $minh_h[] = $row['heure_min'];
    $maxh_h[] = $row['heure_max'];
}

// Récupérer la dernière valeur de chaque tableau
$last_minh_h = end($minh_h);
$last_maxh_h = end($maxh_h);

$connexion->close();
?>
