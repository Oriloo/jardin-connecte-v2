document.addEventListener('DOMContentLoaded', function () {
	// Appeler la fonction pour les éléments avec l'ID #x-1 à #x-4
	addClickEvent('x-1');
	addClickEvent('x-2');
	addClickEvent('x-3');
	addClickEvent('x-4');
});

// Fonction pour ajouter l'événement de clic à un élément avec un ID spécifique
function addClickEvent(elementId) {
	var cancelButton = document.getElementById(elementId);

	if (cancelButton) {
		cancelButton.addEventListener('click', function () {
			// Recharger la page lorsque l'on clique sur l'élément avec l'ID spécifié
			location.reload();
		});
	}
}

function confirmerArrosage(UserID, selectedTable) {
	// Personnalisez le message de confirmation selon vos besoins
	var message = "Êtes-vous sûr de vouloir arroser les plantes ?";
	// Utilisez la fonction confirm() pour afficher la fenêtre de confirmation
	var confirmation = confirm(message);

	// Vérifiez si l'utilisateur a cliqué sur "OK"
	if (confirmation) {
		// l'utilisateur a confirmé
		alert("Arrosage en cours...");
		window.location.href = '../script/EcritureBDD/SaveArrosage.php?UserID=' + UserID + '&selectedTable=' + selectedTable;
	} else {
		// l'utilisateur a annulé
		alert("Arrosage annulé.");
	}
}
