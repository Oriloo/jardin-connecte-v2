<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jardin Connecté</title>
	<link rel="icon" href="image/svg/logo-jc.svg" />
	<link rel="stylesheet" href="style.css">
</head>
<body>


	<div class="vignette mesure-v <?php
	// Initialisation de la variable de classes CSS
	$classes = '';
	// Première condition
	if ($TDtempF <= $last_temp_min || $TDtempF >= $last_temp_max) {
	    $classes .= 'colorAlerte ';
	}
	// Deuxième condition
	if ($TDtempF > $last_temp_min_d && $TDtempF < $last_temp_max_d) {
	    $classes .= 'colorArrose ';
	}
	// Supprimer l'espace à la fin si nécessaire
	$classes = trim($classes);
	// Affichage des classes
	echo $classes;
	?>">
		<h4> Température de l'Air </h4>
		<?php echo $TDtempF; ?>°C
		<div class="svg-vignette"> <?php include('image/svg/temp-ico.svg'); ?> </div>
	</div>

	<div class="vignette mesure-v <?php
	// Initialisation de la variable de classes CSS
	$classes = '';
	// Vérification des conditions pour l'alerte
	if ($TDhumaF <= $last_huma_min || $TDhumaF >= $last_huma_max) {
	    $classes .= 'colorAlerte ';
	}
	// Vérification des conditions pour l'arrosage
	if ($last_huma_si) {
	    if ($TDhumaF > $last_huma_d) {
	        $classes .= 'colorArrose ';
	    }
	} else {
	    if ($TDhumaF < $last_huma_d) {
	        $classes .= 'colorArrose ';
	    }
	}
	// Supprimer l'espace à la fin si nécessaire
	$classes = trim($classes);
	// Affichage des classes
	echo $classes;
	?>">
		<h4> Humidité de l'Air </h4>
		<?php echo $TDhumaF; ?>%
		<div class="svg-vignette"> <?php include('image/svg/humia-ico.svg'); ?> </div>
	</div>

	<div class="vignette mesure-v <?php
	// Initialisation de la variable de classes CSS
	$classes = '';
	// Vérification des conditions pour l'alerte
	if ($TDhumsF <= $last_hums_min || $TDhumsF >= $last_hums_max) {
	    $classes .= 'colorAlerte ';
	}
	// Vérification des conditions pour l'arrosage
	if ($last_hums_si) {
	    if ($TDhumsF > $last_hums_d) {
	        $classes .= 'colorArrose ';
	    }
	} else {
	    if ($TDhumsF < $last_huma_d) {
	        $classes .= 'colorArrose ';
	    }
	}
	// Supprimer l'espace à la fin si nécessaire
	$classes = trim($classes);
	// Affichage des classes
	echo $classes;
	?>">

		<h4> Humidité du Sol </h4>
		<?php echo $TDhumsF; ?>%
		<div class="svg-vignette"> <?php include('image/svg/humis-ico.svg'); ?> </div>
	</div>

	<div class="vignette mesure-v <?php
	// Initialisation de la variable de classes CSS
	$classes = '';
	// Vérification des conditions pour l'alerte
	if ($TDlumiF <= $last_lumi_min || $TDlumiF >= $last_lumi_max) {
	    $classes .= 'colorAlerte ';
	}
	// Vérification des conditions pour l'arrosage
	if ($last_lumi_si) {
	    if ($TDlumiF > $last_lumi_d) {
	        $classes .= 'colorArrose ';
	    }
	} else {
	    if ($TDlumiF < $last_lumi_d) {
	        $classes .= 'colorArrose ';
	    }
	}
	// Supprimer l'espace à la fin si nécessaire
	$classes = trim($classes);
	// Affichage des classes
	echo $classes;
	?>">
		<h4> Luminosité </h4>
		niveau <?php echo $TDlumiF; ?>
		<div class="svg-vignette"> <?php include('image/svg/lumi-ico.svg'); ?> </div>
	</div>

	<div class="vignette">
		<h4> Arrosage </h4>
		Dernier arrosage il y a :<br>
		<?php echo $resultADT; ?>
		<div class="svg-vignette"> <?php include('image/svg/arrosage-ico.svg'); ?> </div>
	</div>

	<div class="vignette">
		<h4> Horaire d'Arrosage </h4>
		<div class="v-info">
			<div class="v-seuils">
				Début<br>
				Fin
			</div>
			<div class="v-valeurs">
				<?php echo $last_maxh_h; ?> h<br>
				<?php echo $last_minh_h; ?> h
			</div>
		</div>
		<div class="svg-vignette"> <?php include('image/svg/horaire-ico.svg'); ?> </div>
	</div>

	<div class="vignette">
		<h4> Seuils d'Alertes </h4>
		<div class="v-info">
			<div class="v-seuils">
				Température<br>
				Humidité Air<br>
				Humidité Sol<br>
				Luminosité
			</div>
			<div class="v-valeurs">
				<?php echo $last_temp_min.' et '.$last_temp_max; ?> °C<br>
				<?php echo $last_huma_min.' et '.$last_huma_max; ?> %<br>
				<?php echo $last_hums_min.' et '.$last_hums_max; ?> %<br>
				niv. <?php echo $last_lumi_min.' et '.$last_lumi_max; ?>
			</div>
		</div>
		<div class="svg-vignette svg-v-petit"> <?php include('image/svg/seuil-alerte-ico.svg'); ?> </div>
	</div>

	<div class="vignette">
		<h4> Seuils d'Arrosages </h4>
		<div class="v-info">
			<div class="v-seuils">
				Température<br>
				Humidité Air<br>
				Humidité Sol<br>
				Luminosité
			</div>
			<div class="v-valeurs">
				<?php echo $last_temp_min_d.' à '.$last_temp_max_d; ?> °C<br>
				<?php echo (($last_huma_si == true) ? '> ' : '< '); echo $last_huma_d; ?> %<br>
				<?php echo (($last_hums_si == true) ? '> ' : '< '); echo $last_hums_d; ?> %<br>
				<?php echo (($last_lumi_si == true) ? '> ' : '< '); echo 'niv. '.$last_lumi_d; ?>
			</div>
		</div>
		<div class="svg-vignette svg-v-petit"> <?php include('image/svg/seuil-arrosage-ico.svg'); ?> </div>
	</div>

	<div class="vignette">
		<h4> Tolérance des seuils </h4>
		<div class="v-info">
			<?php
			$tole_h = floor(($last_tole_t * 15) / 60);
			$tole_m = ($last_tole_t * 15) % 60;
			?>
			Tolérance : <?php echo $tole_h; ?>h <?php echo $tole_m; ?>
		</div>
		<div class="svg-vignette"> <?php include('image/svg/tolerance-ico.svg'); ?> </div>
	</div>
</body>
</html>
