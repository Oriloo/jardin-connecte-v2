<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Icône du site -->
	<link rel="icon" href="image/svg/logo-jc.svg" />

	<!-- Titre de la page -->
	<title>Jardin Connecté</title>

	<!-- Fichiers de styles -->
	<link rel="stylesheet" href="style.css">

	<!-- Plugin Highcharts -->
	<script type="text/javascript" src="biblio/highcharts/jquery.min.js"></script>
	<script type="text/javascript" src="biblio/highcharts/highcharts.js"></script>

	<!-- Plugin Slider -->
	<link rel="stylesheet" href="biblio/range-slider/style.css" />
	<script src="biblio/range-slider/rangeslider.umd.min.js"></script>
</head>

<body>

	<!-- Barres de navigation et de menu du site -->
	<div class="Barres">
		<!-- Barres supérieures du site -->
		<nav class="nav-bar">
			<div class="logo-jc"> <?php include('image/svg/logo-jc-nom.svg'); ?> </div>
			<div class="ico-notife"> <?php include('image/svg/notife-ico.svg'); ?> </div>
		</nav>

		<!-- Barre latérale de menu -->
		<div class="BarreMenu">
			<!-- Informations sur l'utilisateur -->
			<div class="user-info">
				<?php
				// Variable $Avatar contenant le nom de l'avatar avec extension
				$avatarFile = 'image/pp/pp' . 0;
				// Vérifie l'extension du fichier
				if (file_exists($avatarFile . '.png')) {
					$avatarFile .= '.png';
				} elseif (file_exists($avatarFile . '.gif')) {
					$avatarFile .= '.gif';
				} else {
					// Si le fichier n'existe pas, utilisez un avatar par défaut ou un chemin vers une image d'erreur
					$avatarFile = 'image/pp/pp0.png';
				}
				?>
				<img class="pp-user" src="<?php echo $avatarFile; ?>" alt="Avatar"> <br>
				<strong class="grade">
					Administrateur
				</strong>
				<div class="nom"></div>
			</div>

			<!-- Liste des sections avec icônes -->
			<menu id="menu-liste">
				<li value=".tableaubord" id="liste-table">
					<div class="ico-menu">
						<?php include('image/svg/tableau-ico.svg'); ?>
						Tableau de bord
					</div>
				</li>
				<li value=".direct" id="liste-direc">
					<div class="ico-menu direct-pulse">
						<div class="pulse"></div>
						<p>Données en direct</p>
					</div>
				</li>
				<li value=".graphiques" id="liste-grphe">
					<div class="ico-menu">
						<?php include('image/svg/graph-ico.svg'); ?>
						Graphiques
					</div>
				</li>
				<li value=".controles" id="liste-contr">
					<div class="ico-menu">
						<?php include('image/svg/sliders-ico.svg'); ?>
						Contrôles
					</div>
				</li>
				<li value=".historiques" id="liste-histo">
					<div class="ico-menu">
						<?php include('image/svg/hitorique-ico.svg'); ?>
						Historiques
					</div>
				</li>
				<li value=".parametres" id="liste-param">
					<div class="ico-menu">
						<?php include('image/svg/param-ico.svg'); ?>
						Paramètres
					</div>
				</li>

				<div class="autre-option">
					<!-- Bouton de déconnexion -->
					<li value=".deconnexion" id="liste-decon">
						<div class="ico-menu">
							<?php include('image/svg/deco-ico.svg'); ?>
							Déconnexion
						</div>
					</li>

					<!-- Bouton d'aides -->
					<li value=".aides" id="liste-aides">
						<div class="ico-menu">
							<?php include('image/svg/aides-ico.svg'); ?>
							Prise en main
						</div>
					</li>
				</div>
			</menu>
		</div>
	</div>

	<!-- Zone de Notif -->
	<div class="notif"></div>

	<!-- Contenu de la page -->
	<div class="page">
		<div class="titre-page">
			<h3>...</h3>
			<div class="profil-PF">
				<label for="select-profil-text">Données : </label>
				<select class="select-profil" id="select-profil">
					<option value="potager" selected>Potager</option>
					<option value="fleurs">Fleurs</option>
				</select>
			</div>
		</div>

		<!-- Contenu des différentes sections de la page -->
		<div class="tableaubord"></div>
		<div class="direct"></div>
		<div class="graphiques"></div>
		<div class="controles"></div>
		<div class="historiques"></div>
		<div class="parametres"></div>
		<div class="aides"></div>
	</div>

</body>
</html>
