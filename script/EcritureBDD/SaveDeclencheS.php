<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sSI2 = $_POST['select-SI2'];
    $sSI3 = $_POST['select-SI3'];
    $sSI4 = $_POST['select-SI4'];
    $lowerValue11 = $_POST["minInput1-1"];
    $upperValue11 = $_POST["maxInput1-1"];

    if ($sSI2 == 1) {
        $upperValue12 = $_POST["maxInput1-2"];
    } else {
        $upperValue12 = $_POST["minInput1-2"];
    }

    if ($sSI3 == 1) {
        $upperValue13 = $_POST["maxInput1-3"];
    } else {
        $upperValue13 = $_POST["minInput1-3"];
    }

    if ($sSI4 == 1) {
        $upperValue14 = $_POST["maxInput1-4"];
    } else {
        $upperValue14 = $_POST["minInput1-4"];
    }

    $UserID = $_POST["UserID"];
    $selectedTable = $_POST['selectedTable'];
    
    include('../variablesBdd.php');
    include('../variablesTable.php');

    if ($selectedTable == "potager") {
        $Table_ArrosageS = "p_arrosage_seuils";
    } elseif ($selectedTable == "fleurs") {
        $Table_ArrosageS = "f_arrosage_seuils";
    }

    $conn = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Définir le fuseau horaire sur Paris (UTC+1)
    date_default_timezone_set('Europe/Paris');

    $date = date("Y-m-d");
    $heure = date("H:i:s");

    $sql = "INSERT INTO $Table_ArrosageS (date, time, modif_par, temp_min_d, temp_max_d, huma_d, hums_d, lumi_d, huma_si, hums_si, lumi_si) VALUES ('$date', '$heure', '$UserID', '$lowerValue11', '$upperValue11', '$upperValue12', '$upperValue13', '$upperValue14', '$sSI2', '$sSI3', '$sSI4')";

    if ($conn->query($sql) === TRUE) {
        // echo "Enregistrement réussi!";
    } else {
        // echo "Erreur d'enregistrement: " . $conn->error;
    }

    $conn->close();

    // Redirection vers ../index.php
    header("Location: ../../controle/?profil=$selectedTable");
    exit(); // Assure que le script s'arrête après la redirection
}
?>
