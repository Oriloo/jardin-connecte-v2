<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $minV21 = $_POST["minInput2-1"];
    $maxV21 = $_POST["maxInput2-1"];
    $minV22 = $_POST["minInput2-2"];
    $maxV22 = $_POST["maxInput2-2"];
    $minV23 = $_POST["minInput2-3"];
    $maxV23 = $_POST["maxInput2-3"];
    $minV24 = $_POST["minInput2-4"];
    $maxV24 = $_POST["maxInput2-4"];
    $UserID = $_POST["UserID"];
    $selectedTable = $_POST['selectedTable'];

    include('../variablesBdd.php');
    include('../variablesTable.php');

    if ($selectedTable == "potager") {
        $Table_AlertesS = "p_alertes_seuils";
    } elseif ($selectedTable == "fleurs") {
        $Table_AlertesS = "f_alertes_seuils";
    }

    $conn = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Définir le fuseau horaire sur Paris (UTC+1)
    date_default_timezone_set('Europe/Paris');

    $date = date("Y-m-d");
    $heure = date("H:i:s");

    $sql = "INSERT INTO $Table_AlertesS (date, time, modif_par, temp_min, temp_max, huma_min, huma_max, hums_min, hums_max, lumi_min, lumi_max) VALUES ('$date', '$heure', '$UserID', '$minV21', '$maxV21', '$minV22', '$maxV22', '$minV23', '$maxV23', '$minV24', '$maxV24')";

    if ($conn->query($sql) === TRUE) {
        // echo "Enregistrement réussi!";
    } else {
        // echo "Erreur d'enregistrement: " . $conn->error;
    }

    $conn->close();

    // Redirection vers ../index.php
    header("Location: ../../controle/controle.php?profil=$selectedTable");
    exit(); // Assure que le script s'arrête après la redirection
}
?>
