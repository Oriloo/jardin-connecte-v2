<?php
// Définir le fuseau horaire sur Paris (UTC+1)
date_default_timezone_set('Europe/Paris');

$currentDate = date('Y-m-d', strtotime('-1 day'));
$startDate = date('Y-m-d', strtotime('-1 day'));
$selectedOption = 'jour'; // Valeur par défaut

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si la clé 'periode-horaire' existe dans les données POST
    if (isset($_POST['periode-horaire'])) {
        // Récupérer la période sélectionnée du formulaire
        $periodeSelect = $_POST['periode-horaire'];

		$currentDate = date('Y-m-d', strtotime('-1 day'));

		switch ($periodeSelect) {
			case 'jour':
				$startDate = date('Y-m-d', strtotime('-1 day'));
				$selectedOption = 'jour';
				break;
			case 'semaine':
				$startDate = date('Y-m-d', strtotime('-7 day'));
				$selectedOption = 'semaine';
				break;
			case 'mois':
				$startDate = date('Y-m-d', strtotime('-30 day'));
				$selectedOption = 'mois';
				break;
			case 'trimestre':
				$startDate = date('Y-m-d', strtotime('-90 day'));
				$selectedOption = 'trimestre';
				break;
			case 'annee':
				$startDate = date('Y-m-d', strtotime('-1 year'));
				$selectedOption = 'annee';
				break;
			case 'toujours':
				$startDate = '2004-09-09'; // Date de début (peu d'importance)
				$selectedOption = 'toujours';
				break;
			case 'periode':
				$startDate = isset($_POST['date-debut']) ? $_POST['date-debut'] : null;
				$currentDate = isset($_POST['date-fin']) ? $_POST['date-fin'] : null;
				$selectedOption = 'periode';
				break;
		}
	}
}
?>

<!-- permet d'afficher l'option sélectionner après le l'update de la page -->
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez l'élément select
    var periodeHoraireSelect = document.getElementById('periode-horaire');
    var datesPersonnalisees = document.getElementById('dates-personnalisees');

    // Définir l'option sélectionnée sur "jour" au chargement de la page
    periodeHoraireSelect.value = 'jour';

    // Masquer les champs de dates personnalisées au chargement de la page
    datesPersonnalisees.style.display = 'none';
    
    // Ajoutez un gestionnaire d'événements pour le changement de sélection
    periodeHoraireSelect.addEventListener('change', function() {
        // Vérifier si l'option Période personnalisée est sélectionnée
        if (periodeHoraireSelect.value === 'periode') {
            // Afficher les champs de dates personnalisées
            datesPersonnalisees.style.display = 'block';
        } else {
            // Masquer les champs de dates personnalisées
            datesPersonnalisees.style.display = 'none';
        }

        // Vérifier si l'option sélectionnée est différente de 'periode' ou 'toujours'
        if (periodeHoraireSelect.value !== 'periode' && periodeHoraireSelect.value !== 'toujours') {
            // Masquer le bouton de mise à jour
            document.getElementById('ButtonUpdate').style.display = 'none';
        } else {
            // Afficher le bouton de mise à jour
            document.getElementById('ButtonUpdate').style.display = 'block';
        }

        // Stocker la valeur sélectionnée dans le stockage local
        localStorage.setItem('lastSelectedOption', periodeHoraireSelect.value);
    });

    // Vérifiez s'il y a une valeur stockée dans le stockage local
    var lastSelectedOption = localStorage.getItem('lastSelectedOption');

    // Si une valeur est trouvée, sélectionnez l'option correspondante
    if (lastSelectedOption !== null) {
        periodeHoraireSelect.value = lastSelectedOption;

        // Vérifier à nouveau si l'option Période personnalisée est sélectionnée
        if (lastSelectedOption === 'periode') {
            // Afficher les champs de dates personnalisées
            datesPersonnalisees.style.display = 'block';
        }
    }

    // Ajoutez un gestionnaire d'événements pour le formulaire
    document.getElementById('ButtonUpdate').addEventListener('click', function() {
        // Stockez la valeur sélectionnée dans le stockage local avant de soumettre le formulaire
        localStorage.setItem('lastSelectedOption', periodeHoraireSelect.value);
    });
});
</script>
