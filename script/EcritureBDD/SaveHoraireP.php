<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minV41 = $_POST["minInput4-1"];
    $maxV41 = $_POST["maxInput4-1"];
    $UserID = $_POST["UserID"];
    $selectedTable = $_POST['selectedTable'];

    include('../variablesBdd.php');
    include('../variablesTable.php');

    if ($selectedTable == "potager") {
        $Table_ArrosageH = "p_arrosage_horaire";
    } elseif ($selectedTable == "fleurs") {
        $Table_ArrosageH = "f_arrosage_horaire";
    }

    // Conexion à la BDD
    $conn = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Définir le fuseau horaire sur Paris (UTC+1)
    date_default_timezone_set('Europe/Paris');

    // Récupérer la date et l'heure actulle
    $date = date("Y-m-d");
    $heure = date("H:i:s");

    // Ajout des valeurs dans la BDD
    $sql = "INSERT INTO $Table_ArrosageH (date, time, modif_par, heure_min, heure_max) VALUES ('$date', '$heure', '$UserID', '$minV41', '$maxV41')";

    if ($conn->query($sql) === TRUE) {
        // echo "Enregistrement réussi!";
    } else {
        // echo "Erreur d'enregistrement: " . $conn->error;
    }

    // Fin de connexion de la BDD
    $conn->close();

    // Redirection vers ../index.php
    header("Location: ../../controle/?profil=$selectedTable");
    exit(); // Assure que le script s'arrête après la redirection
}
?>
