document.addEventListener('DOMContentLoaded', function () {
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
