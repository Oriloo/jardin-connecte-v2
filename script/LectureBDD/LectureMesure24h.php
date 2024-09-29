<?php
// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Définir le fuseau horaire sur Paris (UTC+1)
date_default_timezone_set('Europe/Paris');

// Récupérer la date et l'heure actuelles
$dateActuelle = date("Y-m-d");
$timeActuelle = date("H:i:s");

// Requête SQL pour récupérer les 100 dernières valeurs triées par date et time
$sql = "SELECT * FROM `$Table_Mesures` 
        WHERE (`date` = '$dateActuelle' AND `time` <= '$timeActuelle')
        OR (`date` < '$dateActuelle')
        ORDER BY `date` DESC, `time` DESC
        LIMIT 100";

$resultat = $connexion->query($sql);

if ($resultat === false) {
    // Gérer l'erreur de la requête
    die("Error executing SQL query: " . $connexion->error);
}

$TDdate = [];
$TDtime = [];
$TDtemp = [];
$TDhuma = [];
$TDhums = [];
$TDlumi = [];

// Traiter les résultats de la requête
while ($row = $resultat->fetch_assoc()) {
    array_unshift($TDdate, $row['date']);
    array_unshift($TDtime, $row['time']);
    array_unshift($TDtemp, $row['temperature_air']);
    array_unshift($TDhuma, $row['humidite_air']);
    array_unshift($TDhums, $row['humidite_sol']);
    array_unshift($TDlumi, $row['lumiere']);
}

// Obtenir les dernières valeurs de chaque tableau
$TDdateF = end($TDdate);
$TDtimeF = end($TDtime);
$TDtempF = end($TDtemp);
$TDhumaF = end($TDhuma);
$TDhumsF = end($TDhums);
$TDlumiF = end($TDlumi);

// Fermer la connexion
$connexion->close();
?>
