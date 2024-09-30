<?php
$serveur = "my_db"; // serveur de la bdd
$utilisateur = "root"; // utilisateur de la bdd
$motDePasse = "rootpassword"; // mot de passe de la bdd
$nomBdd = "jardinconnectetest1"; // nom de la bdd
$nomTable = "p_mesures"; // nom de la table de mesures "p_mesures" ou "f_mesures"
$dateStart = '2023-01-01'; // Date de début de génération
$dateEnd = '2024-12-31'; // Date de fin de génération

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$serveur;dbname=$nomBdd", $utilisateur, $motDePasse);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO $nomTable (date, time, temperature_air, humidite_air, humidite_sol, lumiere) VALUES (?, ?, ?, ?, ?, ?)");

    // Conversion des dates en timestamps
    $startTimestamp = strtotime($dateStart);
    $endTimestamp = strtotime($dateEnd);

    // Boucle sur chaque intervalle de 15 minutes
    for ($timestamp = $startTimestamp; $timestamp <= $endTimestamp; $timestamp += 900) { // 900 secondes = 15 minutes
        $date = date('Y-m-d', $timestamp);
        $time = date('H:i:s', $timestamp);
        
        // Détermination de la saison
        $month = date('n', $timestamp); // Représentation numérique du mois sans les zéros initiaux
        if ($month >= 3 && $month <= 5) {
            $season = 'printemps';
        } elseif ($month >= 6 && $month <= 8) {
            $season = 'été';
        } elseif ($month >= 9 && $month <= 11) {
            $season = 'automne';
        } else {
            $season = 'hiver';
        }

        // Détermination du moment de la journée
        $hour = date('G', $timestamp); // Heure au format 24h sans les zéros initiaux
        if ($hour >= 6 && $hour < 12) {
            $timeOfDay = 'matin';
        } elseif ($hour >= 12 && $hour < 18) {
            $timeOfDay = 'après-midi';
        } elseif ($hour >= 18 && $hour < 22) {
            $timeOfDay = 'soir';
        } else {
            $timeOfDay = 'nuit';
        }

        // Génération de la température de l'air
        $baseTemp = 0;
        switch ($season) {
            case 'hiver':
                $baseTemp = -5;
                break;
            case 'printemps':
                $baseTemp = 10;
                break;
            case 'été':
                $baseTemp = 25;
                break;
            case 'automne':
                $baseTemp = 15;
                break;
        }
        // Ajustement selon le moment de la journée
        switch ($timeOfDay) {
            case 'matin':
                $baseTemp += 2;
                break;
            case 'après-midi':
                $baseTemp += 5;
                break;
            case 'soir':
                $baseTemp += 3;
                break;
            case 'nuit':
                $baseTemp -= 2;
                break;
        }
        // Ajout d'une variation aléatoire
        $temperature_air = $baseTemp + rand(-3, 3) + rand(-10,10)/10;

        // Limitation aux valeurs possibles
        $temperature_air = max(-36.7, min(46.0, $temperature_air));

        // Génération de l'humidité de l'air
        $humidite_air = rand(30, 90); // Valeurs réalistes entre 30% et 90%
        // Génération de l'humidité du sol
        $humidite_sol = rand(20, 80);
        // Génération de la lumière
        if ($timeOfDay == 'nuit') {
            $lumiere = 1; // Nuit
        } else {
            $lumiere = rand(2, 5); // Jour
        }

        // Insertion dans la base de données
        $stmt->execute([$date, $time, $temperature_air, $humidite_air, $humidite_sol, $lumiere]);
    }

    echo "Les données ont été insérées avec succès.";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
