<?php
// Fonction pour récupérer les 20 dernières lignes d'une table
function getLast50Rows($conn, $table) {
    $sql = "SELECT * FROM $table ORDER BY `date` DESC, `time` DESC LIMIT 20";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } else {
        return [];
    }
}

// Connexion à la base de données
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des 40 dernières lignes des tables
$alertes = getLast50Rows($conn, $Table_Alertes);
$arrosage = getLast50Rows($conn, $Table_Arrosage);

// Fermeture de la connexion à la base de données
$conn->close();
?>
