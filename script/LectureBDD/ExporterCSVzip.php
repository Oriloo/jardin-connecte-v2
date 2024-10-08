<?php
// Inclure les variables de connexion
include('../variablesBdd.php');

// Inclure la bibliothèque PclZip
require_once('../../bibliotheque/pclzip.lib.php');

// Création de la connexion
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Liste des tables à exporter
$tables = [
    "p_alertes", "p_alertes_seuils", "p_arrosage", "p_arrosage_horaire", "p_arrosage_seuils",
    "p_mesures", "f_alertes", "f_alertes_seuils", "p_tolerance_seuils", "f_arrosage",
    "f_arrosage_horaire", "f_arrosage_seuils", "f_tolerance_seuils", "f_mesures"
];

// Dossier temporaire pour stocker les fichiers CSV
$tempDir = sys_get_temp_dir() . '/csv_export_' . uniqid();
mkdir($tempDir);

// Création des fichiers CSV pour chaque table
foreach ($tables as $table) {
    $filename = "$tempDir/$table.csv";
    $file = fopen($filename, 'w');

    // Requête SQL pour récupérer les données de la table courante
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Récupération des noms des colonnes
        $row = $result->fetch_assoc();
        $header = array_keys($row);
        fputcsv($file, $header);

        // Réinitialisation du pointeur de résultat et écriture des données dans le fichier CSV
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, $row);
        }
    }

    fclose($file);
}

// Création du fichier ZIP en utilisant PclZip
$zipFilename = "export_all_tables_" . date("Y-m-d_H-i", time()) . ".zip";
$zipFilePath = "$tempDir/$zipFilename";
$zip = new PclZip($zipFilePath);

// Récupérer la liste des fichiers CSV à ajouter
$csvFiles = glob("$tempDir/*.csv");

// Ajouter les fichiers CSV à l'archive ZIP
if ($zip->create($csvFiles, PCLZIP_OPT_REMOVE_PATH, $tempDir) == 0) {
    die("Échec de la création du fichier ZIP : " . $zip->errorInfo(true));
}

// Configuration des en-têtes HTTP pour le téléchargement du fichier ZIP
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
header('Content-Length: ' . filesize($zipFilePath));

// Envoi du fichier ZIP au client
readfile($zipFilePath);

// Nettoyage des fichiers temporaires
array_map('unlink', glob("$tempDir/*.csv"));
unlink($zipFilePath);
rmdir($tempDir);

// Fermeture de la connexion
$conn->close();
?>
