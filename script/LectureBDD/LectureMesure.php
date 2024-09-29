<?php
// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérifier la connexion
if ($connexion->connect_error) {
	die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Exécuter une requête SQL pour récupérer toutes les données
$sql = "SELECT * FROM $Table_Mesures WHERE date BETWEEN '$startDate' AND '$currentDate'";
$resultat = $connexion->query($sql);

if ($resultat === false) {
	// Handle the query error
	die("Error executing SQL query: " . $connexion->error);
}

// Les valeurs de la période prédéfinie
$dates = [];
$times = [];
$temperature_air_data = [];
$humidite_air_data = [];
$humidite_sol_data = [];
$lumiere_data = [];
// Stocker les données dans des tableaux
while ($row = $resultat->fetch_assoc()) {
	$dates[] = $row['date'];
	$times[] = $row['time'];
	$temperature_air_data[] = (float)$row['temperature_air']; // Convertir en nombre
	$humidite_air_data[] = (float)$row['humidite_air']; // Convertir en nombre
	$humidite_sol_data[] = (float)$row['humidite_sol']; // Convertir en nombre
	$lumiere_data[] = (float)$row['lumiere']; // Convertir en nombre
}

// Fermer la connexion
$connexion->close();
?>
