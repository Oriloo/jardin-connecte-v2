<?php
// Vérification si l'option de profil est définie dans l'URL
if(isset($_GET['profil'])) {
	// Récupère la valeur de l'option de profil depuis l'URL
	$selectedTable = $_GET['profil'];
} else {
	// Par défaut, sélectionne "potager"
	$selectedTable = "potager";
}
?>

<script type="text/javascript">
function sauvegarderOptionEtRecharger() {
	var selectElement = document.getElementById("select-profil");
	var selectedTable = selectElement.options[selectElement.selectedIndex].value;
	localStorage.setItem("optionSelectionnee", selectedTable); // Sauvegarde dans le stockage local
	
	// Supprime le paramètre "profil" de l'URL
	var currentUrl = window.location.href;
	var urlWithoutProfileParam = currentUrl.split("?")[0]; // Récupère l'URL sans les paramètres GET

	// Recharge la page avec l'option sélectionnée
	window.location.href = urlWithoutProfileParam + "?profil=" + selectedTable;
}

window.addEventListener('load', function() {
	var selectedTable = "<?php echo $selectedTable; ?>";
	var selectElement = document.getElementById("select-profil");
	selectElement.value = selectedTable; // Définit l'option sélectionnée
});
</script>
