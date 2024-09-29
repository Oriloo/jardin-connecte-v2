<?php
// Nombre de ligne dans la bdd
$nb = count($dates);
// Nombre max de valeur
$max = 500;
if ($nb > 38000)
	$max = 1050;

if ($nb > (2 * $max)) {
	// Combien de fois y a t'il plus de valeur
	$dif = intval($nb / $max);

	$i = 0;
	$max2 = 0;
	while ($max2 < ($max-($dif/2))) {
		$i++;
		$max2 = $i * $dif;
	}

	// calcule des nouvelles data
	for ($i = 0; $i < $max2; $i++) {
		// initialisation à 0 pour chaque boucle
		$total_1 = 0;
		$total_2 = 0;
		$total_3 = 0;
		$total_4 = 0;

		for ($y = 0; $y < $dif; $y++) {
			// faire la moyenne des valeur pour en réduire le nombre
			// j'ai remplacer "+ $y" par "+ 0" pour prandre 1/$dif valeur au lieu d'en faire la moyenne
			$b = $i * $dif + 0;
			$total_1 = $total_1 + $temperature_air_data[$b];
			$total_2 = $total_2 + $humidite_air_data[$b];
			$total_3 = $total_3 + $humidite_sol_data[$b];
			$total_4 = $total_4 + $lumiere_data[$b];
		}
		// ajouter les valeur à leur tableau		
		$Date[$i] = $dates[$i * $dif];
		$Time[$i] = $times[$i * $dif];
		$TemA[$i] = round($total_1 / $dif, 2);
		$HumA[$i] = round($total_2 / $dif, 2);
		$HumS[$i] = round($total_3 / $dif, 2);
		$Lumi[$i] = round($total_4 / $dif, 2);
	}
} else {
	// ajouter les valeur à leur tableau
	for ($i = 0; $i < $nb; $i++) {
		$Date[$i] = $dates[$i];
		$Time[$i] = $times[$i];
		$TemA[$i] = $temperature_air_data[$i];
		$HumA[$i] = $humidite_air_data[$i];
		$HumS[$i] = $humidite_sol_data[$i];
		$Lumi[$i] = $lumiere_data[$i];
	}
}

$TemA_Moy = 0;
$HumA_Moy = 0;
$HumS_Moy = 0;
$Lumi_Moy = 0;
// Calcul de la Moyenne
for ($i = 0; $i < $nb; $i++) {
    // Vérifier si l'indice existe dans le tableau
    if (isset($temperature_air_data[$i]))
        $TemA_Moy += $temperature_air_data[$i];
    if (isset($humidite_air_data[$i]))
        $HumA_Moy += $humidite_air_data[$i];
    if (isset($humidite_sol_data[$i]))
        $HumS_Moy += $humidite_sol_data[$i];
    if (isset($lumiere_data[$i]))
        $Lumi_Moy += $lumiere_data[$i];
}
$TemA_Moy = ($nb > 0) ? round($TemA_Moy / $nb, 2) : 0;
$HumA_Moy = ($nb > 0) ? round($HumA_Moy / $nb, 2) : 0;
$HumS_Moy = ($nb > 0) ? round($HumS_Moy / $nb, 2) : 0;
$Lumi_Moy = ($nb > 0) ? round($Lumi_Moy / $nb, 2) : 0;
?>
