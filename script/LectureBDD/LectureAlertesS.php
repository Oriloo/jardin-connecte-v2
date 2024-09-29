<?php
// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$sql = "SELECT * FROM $Table_AlertesS";
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Handle the query error
    die("Error executing SQL query: " . $connexion->error);
}

// Les valeurs de la table alertes_seuils
$date_d = [];
$time_d = [];
$user_d = [];
$temp_min = [];
$temp_max = [];
$huma_min = [];
$huma_max = [];
$hums_min = [];
$hums_max = [];
$lumi_min = [];
$lumi_max = [];

// Stocker les données dans des tableaux
while ($row = $resultat->fetch_assoc()) {
    $date_d[] = $row['date'];
    $time_d[] = $row['time'];
    $user_d[] = $row['modif_par'];
    $temp_min[] = $row['temp_min'];
    $temp_max[] = $row['temp_max'];
    $huma_min[] = $row['huma_min'];
    $huma_max[] = $row['huma_max'];
    $hums_min[] = $row['hums_min'];
    $hums_max[] = $row['hums_max'];
    $lumi_min[] = $row['lumi_min'];
    $lumi_max[] = $row['lumi_max'];
}

// Récupérer la dernière valeur de chaque tableau
$last_temp_min = end($temp_min);
$last_temp_max = end($temp_max);
$last_huma_min = end($huma_min);
$last_huma_max = end($huma_max);
$last_hums_min = end($hums_min);
$last_hums_max = end($hums_max);
$last_lumi_min = end($lumi_min);
$last_lumi_max = end($lumi_max);

$connexion->close();
?>
