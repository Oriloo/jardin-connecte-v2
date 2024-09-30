<?php
include('../connexion/test-connexion.php')
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jardin Connecté | Graphique</title>
	<link rel="icon" href="../image/svg/logo-jc.svg" />
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="s-graphique.css">
	<!-- Bibliothèques -->
	<script type="text/javascript" src="../bibliotheque/jquery.min.js"></script>
	<script type="text/javascript" src="../bibliotheque/highcharts.js"></script>
</head>

<body>
	<?php
	include('../script/SelectionTable.php');
	include('../menu.php');
	include('../script/variablesBdd.php');
	include('../script/variablesTable.php');
	?>

	<div class="page">
		<div class="titre-page">
			<h3>Graphique</h3>
			<div class="profil-PF">
				<label for="select-profil-text">Données : </label>
				<select class="select-profil" id="select-profil">
					<option value="potager" selected>Potager</option>
					<option value="fleurs">Fleurs</option>
				</select>
				<script type="text/javascript" src="../script/profil.js"></script>
			</div>
		</div>

		<div class="graphiques">

			<div id="navigation">
				<a onclick="showContainer('container1')" class="clicked">
					Température <br>
					<span id="TemA_Moy"></span>°C
				</a>
				<a onclick="showContainer('container2')">
					Humidité Air <br>
					<span id="HumA_Moy"></span>%
				</a>
				<a onclick="showContainer('container3')">
					Humidité Sol <br>
					<span id="HumS_Moy"></span>%
				</a>
				<a onclick="showContainer('container4')">
					Luminosité <br>
					Niveau <span id="Lumi_Moy"></span>
				</a>

				<form method="post">
					<div class="select_date">
						<div class="dates-personnalisees" id="dates-personnalisees">
							<label for="date-debut">Début</label>
							<input type="date" id="date-debut" name="date-debut" oninput="PeriodeUpdate()">
							<br><label for="date-fin">Fin</label>
							<input type="date" id="date-fin" name="date-fin" oninput="PeriodeUpdate()">
						</div>

						<div class="triangle triangle-open"> <?php include('../image/svg/triangle-ico.svg'); ?> </div>
						<select name="periode-horaire" id="periode-horaire" onchange="PeriodeUpdate()">
							<option value="jour">Le dernier jour</option>
							<option value="semaine">7 derniers jours</option>
							<option value="mois">30 derniers jours</option>
							<option value="trimestre">90 derniers jours</option>
							<option value="annee">365 derniers jours</option>
							<option value="toujours">Depuis toujours</option>
							<option value="periode">Periode personnalisée</option>
						</select>
						
						<button type="submit" id="ButtonUpdate" disabled>
							<div id="Update"> <?php include('../image/svg/update-ico.svg'); ?> </div>
						</button>
					</div>
				</form>
			</div>

			<?php
			include('../script/SelectionDate.php');
			include('../script/LectureBDD/LectureMesure.php');
			include('../script/Calcule.php');
			include('../script/GraphePrincipal.php');
			?>

			<div class="visualiser">
				<div id="container1" class="container active"></div>
				<div id="container2" class="container"></div>
				<div id="container3" class="container"></div>
				<div id="container4" class="container"></div>
			</div>

			<div class="containerlegende">
				<div class="legende">
					<div class="colonneLegende">
						Niveau 1 : Eclairage public (20 lux)<br>
						Niveau 2 : Jour très couvert (100 lux)<br>
						Niveau 3 : Jour couvert (1 000 lux)<br>
						Niveau 4 : Jour typique (10 000 lux)<br>
						Niveau 5 : Eté ensoleillée (50 000 lux)<br>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
	var temAMoy = <?php echo json_encode($TemA_Moy); ?>;
	var humAMoy = <?php echo json_encode($HumA_Moy); ?>;
	var humSMoy = <?php echo json_encode($HumS_Moy); ?>;
	var lumiMoy = <?php echo json_encode($Lumi_Moy); ?>;
    document.getElementById('TemA_Moy').innerText = temAMoy;
    document.getElementById('HumA_Moy').innerText = humAMoy;
    document.getElementById('HumS_Moy').innerText = humSMoy;
    document.getElementById('Lumi_Moy').innerText = lumiMoy;

	/////////////////////////////////////////////////////////////////////////

	// Récupérer les dates du tableau $Date
	var dates = <?php echo json_encode($Date); ?>;
	// Convertir les dates en objets JavaScript Date
	var dateDebut = new Date(dates[0]);
	var dateFin = new Date(dates[dates.length - 1]);

	// Formater les dates pour les champs de date (YYYY-MM-DD)
	var formatDate = function (date) {
		var year = date.getFullYear();
		var month = String(date.getMonth() + 1).padStart(2, '0');
		var day = String(date.getDate()).padStart(2, '0');
		return `${year}-${month}-${day}`;
	};

	// Remplir automatiquement les champs de date avec la première et la dernière date du graphique
	document.getElementById('date-debut').value = formatDate(dateDebut);
	document.getElementById('date-fin').value = formatDate(dateFin);

	/////////////////////////////////////////////////////////////////////////

	var select = document.getElementById('periode-horaire');
	var triangle = document.querySelector('.triangle');
	var isSelectFocused = false;

	// Fonction pour détecter l'état du select
	function handleSelectState() {
		isSelectFocused = select === document.activeElement;
		if (isSelectFocused) {
			// Le select est ouvert, ajouter la classe
			triangle.classList.add('triangle-open');
		} else {
			// Le select est fermé, retirer la classe
			triangle.classList.remove('triangle-open');
		}
	}

	// Attacher un gestionnaire d'événement au select pour détecter son état
	select.addEventListener('focus', handleSelectState);
	select.addEventListener('blur', handleSelectState);

	// Initial setup: Le triangle est fermé au chargement de la page
	triangle.classList.remove('triangle-open');

	// Attacher un gestionnaire d'événement au document pour détecter le clic n'importe où
	document.addEventListener('mousedown', function (event) {
		// Vérifier si le select est ouvert avant de retirer la classe
		if (isSelectFocused) {
			triangle.classList.remove('triangle-open');
		}
	});

	// Cacher la légende par défaut
	var legendeDiv = document.querySelector('.containerlegende');
	legendeDiv.style.display = 'none';

	// Fonction pour gérer le changement d'option dans le menu déroulant
	function handleSelectChange() {
		var select = document.getElementById('periode-horaire');
		var selectedOption = select.value;
		var buttonUpdate = document.getElementById('ButtonUpdate');

		// Si l'option sélectionnée est "periode", affichez le bouton de mise à jour
		if (selectedOption === "periode") {
			buttonUpdate.style.display = 'block';
			buttonUpdate.disabled = false;
		} else {
			// Sinon, masquez le bouton de mise à jour
			buttonUpdate.style.display = 'none';
			// Et soumettez automatiquement le formulaire
			document.querySelector('form').submit();
		}
	}

	// Masquer le bouton de mise à jour par défaut
	var buttonUpdate = document.getElementById('ButtonUpdate');
	buttonUpdate.style.display = 'none';

	// Vérifier l'option sélectionnée au chargement de la page
	var select = document.getElementById('periode-horaire');
	var selectedOption = select.value;

	if (selectedOption === "periode") {
		buttonUpdate.style.display = 'block';
	}

	// Attachez le gestionnaire d'événement onchange au menu déroulant
	select.addEventListener('change', handleSelectChange);
});

// Fonction permettant d'afficher le conteneur sélectionné
function showContainer(containerId) {
	// Ajouter la classe "clicked" par défaut à l'élément "Température"
	document.addEventListener('DOMContentLoaded', function() {
		var defaultLink = document.querySelector('#navigation a.clicked');
		if (!defaultLink)
			document.querySelector('#navigation a').classList.add('clicked');
	});

	// Cacher tous les conteneurs
	var containers = document.getElementsByClassName('container');
	for (var i = 0; i < containers.length; i++)
		containers[i].classList.remove('active');

	// Afficher le conteneur sélectionné
	var selectedContainer = document.getElementById(containerId);
	selectedContainer.classList.add('active');

	// Ajouter la classe "clicked" à l'élément sélectionner
	var links = document.getElementsByTagName('a');
	for (var i = 0; i < links.length; i++)
		links[i].classList.remove('clicked');
	event.target.classList.add('clicked');

	// Cacher la légende si le container 4 n'est pas affiché
	var legendeDiv = document.querySelector('.containerlegende');
	legendeDiv.style.display = (containerId === 'container4') ? 'block' : 'none';
}
</script>
</body>
</html>
