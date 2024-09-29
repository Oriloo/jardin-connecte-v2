<?php
// Inclure les variables de connexion
include('../variablesBdd.php');

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

// Création d'un fichier CSV temporaire
$filename = "export_all_tables_" . date("Y-m-d_H-i", time()) . ".csv";
$file = fopen('php://output', 'w');

// Configuration des en-têtes HTTP pour le téléchargement du fichier CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $filename . '"');

foreach ($tables as $table) {
    // Requête SQL pour récupérer les données de la table courante
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Écrire le nom de la table comme en-tête
        fputcsv($file, [$table]);

        // Récupération des noms des colonnes
        $row = $result->fetch_assoc();
        $header = array_keys($row);
        fputcsv($file, $header);

        // Réinitialisation du pointeur de résultat et écriture des données dans le fichier CSV
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, $row);
        }

        // Ajouter une ligne vide entre les tables pour la lisibilité
        fputcsv($file, []);
    }
}

// Fermeture de la connexion
fclose($file);
$conn->close();
?>
