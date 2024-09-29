<?php
// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$sql = "SELECT * FROM $Table_ArrosageS";
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Handle the query error
    die("Error executing SQL query: " . $connexion->error);
}

// Les valeurs de la table declencher_seuils
$date_d = [];
$time_d = [];
$user_d = [];
$temp_min_d = [];
$temp_max_d = [];
$huma_d = [];
$hums_d = [];
$lumi_d = [];
$huma_si = [];
$hums_si = [];
$lumi_si = [];
// Stocker les données dans des tableaux
while ($row = $resultat->fetch_assoc()) {
    $date_d[] = $row['date'];
    $time_d[] = $row['time'];
    $user_d[] = $row['modif_par'];
    $temp_min_d[] = $row['temp_min_d'];
    $temp_max_d[] = $row['temp_max_d'];
    $huma_d[] = $row['huma_d'];
    $hums_d[] = $row['hums_d'];
    $lumi_d[] = $row['lumi_d'];
    $huma_si[] = $row['huma_si'];
    $hums_si[] = $row['hums_si'];
    $lumi_si[] = $row['lumi_si'];
}

// Récupérer la dernière valeur de chaque tableau
$last_temp_min_d = end($temp_min_d);
$last_temp_max_d = end($temp_max_d);
$last_huma_d = end($huma_d);
$last_hums_d = end($hums_d);
$last_lumi_d = end($lumi_d);
$last_huma_si = end($huma_si);
$last_hums_si = end($hums_si);
$last_lumi_si = end($lumi_si);

$connexion->close();
?>
