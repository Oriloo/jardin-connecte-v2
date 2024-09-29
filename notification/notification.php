<?php
// Vérifier si le paramètre 'profil' existe dans l'URL
if (isset($_GET['profil'])) {
    // Récupérer la valeur du paramètre 'profil'
    $profil = $_GET['profil'];
} else {
    // Le paramètre 'profil' n'est pas présent dans l'URL
}

$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $nomBdd);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Connexion échouée: " . $connexion->connect_error);
}

?>

<!-- Fenêtre -->
<div class="nav-notif">
    <div class="titre-notif">Notifications
        <span> <?php echo $profil; ?> </span>
    </div>
    <div class="ico-notife2"> <?php include('image/svg/notife-ico.svg'); ?> </div>
</div>

<div class="zone-notif">
    <?php
    // Fusion des résultats des deux tableaux
    $merged = array_merge($alertes, $arrosage);

    // Tri des résultats fusionnés par date et time en ordre décroissant
    usort($merged, function($a, $b) {
        $dateTimeA = strtotime($a['date'] . ' ' . $a['time']);
        $dateTimeB = strtotime($b['date'] . ' ' . $b['time']);
        return $dateTimeB - $dateTimeA;
    });

    // Affichage des résultats triés
    foreach ($merged as $row) {
        echo "<div class='notif-item'>";
        echo "<strong>Date:</strong> " . $row['date'] . " <strong>Time:</strong> " . $row['time'] . "<br>";

        // Vérification du type
        $type = isset($row['declencher_par']) ? "Arrosage" : "Alerte";
        echo "<strong>Type : <a class='notif-".$type."'>".$type."</a></strong><br>";

        // Construction du message
        $message = "";
        if ($type === "Arrosage") {
	        // Récupération du nom d'utilisateur à partir de l'ID
	        $id = $row['declencher_par'];
	        $userName = "";

	        if ($id != 0) {
	            // Préparation de la requête SQL
	            $requete = "SELECT login FROM $Table_Utilisateur WHERE id = $id";

	            // Exécution de la requête
	            $resultat = $connexion->query($requete);

	            // Vérification du résultat de la requête
	            if ($resultat->num_rows > 0) {
	                // Récupération du nom d'utilisateur
	                $ligne = $resultat->fetch_assoc();
	                $userName = $ligne['login'];
	            }
	        } else { $userName = "le programme"; }
            $message .= "Déclenché par ".$userName;
        } else {
            $message .= "Seuils dépassés : ";
            if ($row['temp_alerte'] != 0) { $message .= "Température, "; }
            if ($row['huma_alerte'] != 0) { $message .= "Humidité de l'air, "; }
            if ($row['hums_alerte'] != 0) { $message .= "Humidité du sol, "; }
            if ($row['lumi_alerte'] != 0) { $message .= "Luminosité, "; }
        }
        echo $message."</div>";
    }
    // Fermeture de la connexion
    $connexion->close();
    ?>
</div>
