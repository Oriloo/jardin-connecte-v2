<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si la clé 'dateDay' existe dans les données POST
    if (isset($_POST['dateDay'])) {
        // Récupérer la date du formulaire
        $dateFormulaire = $_POST['dateDay'];
    }
}

// Définir le fuseau horaire sur Paris (UTC+1)
date_default_timezone_set('Europe/Paris');

// Récupérer la date actuelle
$dateActuelle = date("Y-m-d");
$timeActuelle = date("H:i:s");

//-------------------------------------------------------------------------------------

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

//-------------------------------------------------------------------------------------

// Exécuter une requête SQL pour récupérer toutes les données pour la date actuelle
if (empty($dateFormulaire) || ($dateActuelle == $dateFormulaire)) {
    $sql = "SELECT * FROM $Table_Mesures WHERE date = '$dateActuelle' AND time < '$timeActuelle'";
} else {
    $sql = "SELECT * FROM $Table_Mesures WHERE date = '$dateFormulaire'";
}
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Gérer l'erreur de la requête
    die("Error executing SQL query: " . $connexion->error);
}

$DAY1_date = [];
$DAY1_time = [];
$DAY1_temp = [];
$DAY1_huma = [];
$DAY1_hums = [];
$DAY1_lumi = [];

// Traiter les résultats de la requête
while ($row = $resultat->fetch_assoc()) {
    $DAY1_date[] = $row['date'];
    $DAY1_time[] = $row['time'];
    $DAY1_temp[] = $row['temperature_air'];
    $DAY1_huma[] = $row['humidite_air'];
    $DAY1_hums[] = $row['humidite_sol'];
    $DAY1_lumi[] = $row['lumiere'];
}

//-------------------------------------------------------------------------------------

// Exécuter une requête SQL pour récupérer toutes les données pour la date actuelle
if (empty($dateFormulaire) || ($dateActuelle == $dateFormulaire)) {
    $sql = "SELECT * FROM $Table_Alertes ORDER BY date DESC, time DESC LIMIT 100";
} else {
    $sql = "SELECT * FROM $Table_Alertes WHERE date = '$dateFormulaire'";
}
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Gérer l'erreur de la requête
    die("Error executing SQL query: " . $connexion->error);
}

$DAY2_date = [];
$DAY2_time = [];
$DAY2_temp = [];
$DAY2_huma = [];
$DAY2_hums = [];
$DAY2_lumi = [];

// Traiter les résultats de la requête
while ($row = $resultat->fetch_assoc()) {
    $DAY2_date[] = $row['date'];
    $DAY2_time[] = $row['time'];
    $DAY2_temp[] = $row['temp_alerte'];
    $DAY2_huma[] = $row['huma_alerte'];
    $DAY2_hums[] = $row['hums_alerte'];
    $DAY2_lumi[] = $row['lumi_alerte'];
}

//-------------------------------------------------------------------------------------

// Exécuter une requête SQL pour récupérer toutes les données pour la date actuelle
if (empty($dateFormulaire) || ($dateActuelle == $dateFormulaire)) {
    $sql = "SELECT * FROM $Table_AlertesS ORDER BY date DESC, time DESC LIMIT 100";
} else {
    $sql = "SELECT * FROM $Table_AlertesS WHERE date = '$dateFormulaire'";
}
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Gérer l'erreur de la requête
    die("Error executing SQL query: " . $connexion->error);
}

$DAY3_date = [];
$DAY3_time = [];
$DAY3_modif = [];
$DAY3_tempMin = [];
$DAY3_tempMax = [];
$DAY3_humaMin = [];
$DAY3_humaMax = [];
$DAY3_humsMin = [];
$DAY3_humsMax = [];
$DAY3_lumiMin = [];
$DAY3_lumiMax = [];

// Traiter les résultats de la requête
while ($row = $resultat->fetch_assoc()) {
    $DAY3_date[] = $row['date'];
    $DAY3_time[] = $row['time'];
    $DAY3_modif[] = $row['modif_par'];
    $DAY3_tempMin[] = $row['temp_min'];
    $DAY3_tempMax[] = $row['temp_max'];
    $DAY3_humaMin[] = $row['huma_min'];
    $DAY3_humaMax[] = $row['huma_max'];
    $DAY3_humsMin[] = $row['hums_min'];
    $DAY3_humsMax[] = $row['hums_max'];
    $DAY3_lumiMin[] = $row['lumi_min'];
    $DAY3_lumiMax[] = $row['lumi_max'];
}

//-------------------------------------------------------------------------------------

// Exécuter une requête SQL pour récupérer toutes les données pour la date actuelle
if (empty($dateFormulaire) || ($dateActuelle == $dateFormulaire)) {
    $sql = "SELECT * FROM $Table_Arrosage ORDER BY date DESC, time DESC LIMIT 100";
} else {
    $sql = "SELECT * FROM $Table_Arrosage WHERE date = '$dateFormulaire'";
}
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Gérer l'erreur de la requête
    die("Error executing SQL query: " . $connexion->error);
}

$DAY4_date = [];
$DAY4_time = [];
$DAY4_modif = [];

// Traiter les résultats de la requête
while ($row = $resultat->fetch_assoc()) {
    $DAY4_date[] = $row['date'];
    $DAY4_time[] = $row['time'];
    $DAY4_modif[] = $row['declencher_par'];
}

//-------------------------------------------------------------------------------------

// Exécuter une requête SQL pour récupérer toutes les données pour la date actuelle
if (empty($dateFormulaire) || ($dateActuelle == $dateFormulaire)) {
    $sql = "SELECT * FROM $Table_ArrosageH ORDER BY date DESC, time DESC LIMIT 100";
} else {
    $sql = "SELECT * FROM $Table_ArrosageH WHERE date = '$dateFormulaire'";
}
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Gérer l'erreur de la requête
    die("Error executing SQL query: " . $connexion->error);
}

$DAY5_date = [];
$DAY5_time = [];
$DAY5_modif = [];
$DAY5_minh = [];
$DAY5_maxh = [];

// Traiter les résultats de la requête
while ($row = $resultat->fetch_assoc()) {
    $DAY5_date[] = $row['date'];
    $DAY5_time[] = $row['time'];
    $DAY5_modif[] = $row['modif_par'];
    $DAY5_minh[] = $row['heure_min'];
    $DAY5_maxh[] = $row['heure_max'];
}

//-------------------------------------------------------------------------------------

// Exécuter une requête SQL pour récupérer toutes les données pour la date actuelle
if (empty($dateFormulaire) || ($dateActuelle == $dateFormulaire)) {
    $sql = "SELECT * FROM $Table_ArrosageS ORDER BY date DESC, time DESC LIMIT 100";
} else {
    $sql = "SELECT * FROM $Table_ArrosageS WHERE date = '$dateFormulaire'";
}
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Handle the query error
    die("Error executing SQL query: " . $connexion->error);
}

// Les valeurs de la table declencher_seuils
$DAY6_date = [];
$DAY6_time = [];
$DAY6_modif = [];
$DAY6_tempMin = [];
$DAY6_tempMax = [];
$DAY6_huma = [];
$DAY6_hums = [];
$DAY6_lumi = [];
// Stocker les données dans des tableaux
while ($row = $resultat->fetch_assoc()) {
    $DAY6_date[] = $row['date'];
    $DAY6_time[] = $row['time'];
    $DAY6_modif[] = $row['modif_par'];
    $DAY6_tempMin[] = $row['temp_min_d'];
    $DAY6_tempMax[] = $row['temp_max_d'];
    $DAY6_huma[] = $row['huma_d'];
    $DAY6_hums[] = $row['hums_d'];
    $DAY6_lumi[] = $row['lumi_d'];
}

//-------------------------------------------------------------------------------------

// Exécuter une requête SQL pour récupérer toutes les données pour la date actuelle
if (empty($dateFormulaire) || ($dateActuelle == $dateFormulaire)) {
    $sql = "SELECT * FROM $Table_ToleranceS ORDER BY date DESC, time DESC LIMIT 100";
} else {
    $sql = "SELECT * FROM $Table_ToleranceS WHERE date = '$dateFormulaire'";
}
$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Handle the query error
    die("Error executing SQL query: " . $connexion->error);
}

// Les valeurs de la table declencher_seuils
$DAY7_date = [];
$DAY7_time = [];
$DAY7_modif = [];
$DAY7_tole = [];
// Stocker les données dans des tableaux
while ($row = $resultat->fetch_assoc()) {
    $DAY7_date[] = $row['date'];
    $DAY7_time[] = $row['time'];
    $DAY7_modif[] = $row['modif_par'];
    $DAY7_tole[] = $row['tolerance'];
}

//-------------------------------------------------------------------------------------

// Fermer la connexion
$connexion->close();
?>
