// Fonction pour initialiser le compte à rebours
function initCountdown(TDtimeF) {
	var countdownElement = document.getElementById('countdown');
	// Définir l'heure cible pour le compte à rebours
	// var TDtimeF = "<?php echo $TDtimeF; ?>"; // Heure de départ
	var targetTime = new Date();
	// Convertir la chaîne d'heure en objet Date
	var hoursMinutesSeconds = TDtimeF.split(":");
	targetTime.setMinutes(parseInt(hoursMinutesSeconds[1], 10) + 16); // Ajouter 16 minutes
	targetTime.setSeconds(parseInt(hoursMinutesSeconds[2], 10));
	// Mettre à jour le compte à rebours toutes les secondes
	var countdownInterval = setInterval(function() {
		var currentTime = new Date();
		var timeDifference = targetTime - currentTime;
		// Vérifier si le temps est écoulé
		if (timeDifference <= 0) {
			clearInterval(countdownInterval);
			// Recharger la page si la section active est "Tableau de bord" ou "Données en direct"
			var activeSection = sessionStorage.getItem('activeSection');
			if (activeSection === '.tableaubord' || activeSection === '.direct') {
				window.location.href = window.location.href; // Recharge la page en forçant le navigateur à ignorer le cache
			}
		} else {
			// Calculer les heures, minutes et secondes restantes
			var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
			// Afficher le compte à rebours dans le div
			countdownElement.innerHTML = "Mise à jour des données estimées dans mois de " + minutes + "m " + seconds + "s";
		}
	}, 1000); // Mettre à jour toutes les 1000 millisecondes (1 seconde)
}

initCountdown(TDtimeF);
