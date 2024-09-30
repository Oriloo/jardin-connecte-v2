<?php
$UserID = $_GET["ID"];
$Theme = $_GET['Theme'];

include('../variablesBdd.php');
include('../variablesTable.php');

$conn = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prévenir les injections SQL en utilisant des requêtes préparées
$stmt = $conn->prepare("SELECT * FROM $Table_Utilisateur WHERE BINARY id = ? ");
$stmt->bind_param("s", $UserID); // Adjusted to "s"

// Exécuter la requête
if ($stmt->execute()) {
    // Récupérer le résultat
    $resultat = $stmt->get_result();

    // Vérifier si l'utilisateur existe
    if ($resultat->num_rows > 0) {
        // Mettre à jour la colonne "avatar" de l'utilisateur avec la valeur de $Theme
        $updateStmt = $conn->prepare("UPDATE $Table_Utilisateur SET theme = ? WHERE id = ?");
        $updateStmt->bind_param("ss", $Theme, $UserID);
        $updateStmt->execute();
        $updateStmt->close();
        // Définir un cookie pour indiquer le succès
        setcookie('theme_updated', 'true', time() + 5, '/'); // Expire après 5 secondes
    } else {
        // Définir un cookie pour indiquer l'échec
        setcookie('theme_updated', 'false', time() + 5, '/'); // Expire après 5 secondes
    }
} else {
    // Handle execution error
    die("Query execution failed: " . $conn->error);
}

// Fermer la connexion
$stmt->close();
$conn->close();

// Redirection vers ../index.php
header("Location: ../../parametre/?profil=potager");
exit(); // Assure que le script s'arrête après la redirection
?>
