document.addEventListener("DOMContentLoaded", function() {
	// Fonction pour récupérer la valeur du cookie
	function getCookie(name) {
		var value = "; " + document.cookie;
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}

	////////////////////////////////////// Changer d'Avatar //////////////////////////////////////
	const profilePics = document.querySelectorAll('.profile-pic');
	let selectedAvatarPic = null;
	let selectedAvatarValue = null;

	profilePics.forEach(function(pic) {
		pic.addEventListener('click', function() {
			profilePics.forEach(function(p) {
				p.classList.remove('selected');
			});
			this.classList.add('selected');
			selectedAvatarPic = this;
			selectedAvatarValue = this.getAttribute('value'); // Mettez à jour la valeur de l'image sélectionnée
		});
	});

	document.getElementById('v-pp').addEventListener('click', function() {
		// Vérifier si une image est sélectionnée
		if (selectedAvatarValue) {
			// Demander confirmation pour changer la photo de profil
			if (confirm("Voulez-vous changer votre photo de profil ?")) {
				window.location.href = `../script/EcritureBDD/SaveAvatar.php?ID=` + UserID + `&avatarPP=${selectedAvatarValue}`; // Utilisez la valeur de l'image sélectionnée
			} else {
				// Si l'utilisateur annule, ne rien faire
				console.log("Changement de photo de profil annulé.");
			}
		} else {
			// Si aucune image n'est sélectionnée, demander de sélectionner une image
			alert("Veuillez sélectionner une image pour changer votre photo de profil.");
		}
	});

	// Vérifier si le cookie est défini pour afficher la popup
	var avatarUpdated = getCookie('avatar_updated');
	if (avatarUpdated === 'true') {
		if (confirm("La photo de profil a été mise à jour avec succès ! Pour voir le changement, veuillez vous reconnecter.\nVoulez-vous vous déconnecter maintenant ?")) {
			window.location.href = "../connexion/logout.php";
		}
	} else if (avatarUpdated === 'false') {
		alert("Erreur lors de la mise à jour de la photo de profil. Veuillez réessayer.");
	}

	// Appeler la fonction pour les éléments avec l'ID #x-pp
	addClickEvent('x-pp');

	////////////////////////////////////// Changer de Theme //////////////////////////////////////
	const themePics = document.querySelectorAll('.theme-pic');
	let selectedThemePic = null;
	let selectedThemeValue = null;

	themePics.forEach(function(pic) {
		pic.addEventListener('click', function() {
			themePics.forEach(function(p) {
				p.classList.remove('selected');
			});
			this.classList.add('selected');
			selectedThemePic = this;
			selectedThemeValue = this.getAttribute('value'); // Mettez à jour la valeur du theme sélectionnée
		});
	});

	document.getElementById('v-theme').addEventListener('click', function() {
		// Vérifier si un theme est sélectionnée
		if (selectedThemeValue) {
			// Demander confirmation pour changer le thème du site
			if (confirm("Voulez-vous changer le thème du site ?")) {
				window.location.href = `../script/EcritureBDD/SaveTheme.php?ID=` + UserID + `&Theme=${selectedThemeValue}`; // Utilisez la valeur de l'image sélectionnée
			} else {
				// Si l'utilisateur annule, ne rien faire
				console.log("Changement du thème annulé.");
			}
		} else {
			// Si aucune image n'est sélectionnée, demander de sélectionner une couleur
			alert("Veuillez sélectionner une couleur pour changer le thème du site.");
		}
	});

	// Vérifier si le cookie est défini pour afficher la popup
	var avatarUpdated = getCookie('theme_updated');
	if (avatarUpdated === 'true') {
		if (confirm("Le thème du site a été mise à jour avec succès ! Pour voir le changement, veuillez vous reconnecter.\nVoulez-vous vous déconnecter maintenant ?")) {
			window.location.href = "../connexion/logout.php";
		}
	} else if (avatarUpdated === 'false') {
		alert("Erreur lors de la mise à jour du thème du site. Veuillez réessayer.");
	}

	themePics.forEach(function(pic) {
		pic.addEventListener('click', function() {
			const theme = this.getAttribute('value');
				document.documentElement.classList.remove('theme-sombre');
				document.documentElement.classList.remove('theme-clair');
				document.documentElement.classList.remove('theme-noir');
				document.documentElement.classList.remove('theme-neon');
				document.documentElement.classList.remove('theme-grie');
				document.documentElement.classList.remove('theme-orange');

			if (theme === '0') {
				document.documentElement.classList.add('theme-clair');
			} else if (theme === '1') {
				document.documentElement.classList.add('theme-sombre');
			} else if (theme === '2') {
				document.documentElement.classList.add('theme-noir');
			} else if (theme === '3') {
				document.documentElement.classList.add('theme-neon');
			} else if (theme === '4') {
				document.documentElement.classList.add('theme-grie');
			} else if (theme === '5') {
				document.documentElement.classList.add('theme-orange');
			}
		});
	});

	// Appliquer le thème par défaut
	if (defaultThemeValue === '0') {
		document.documentElement.classList.add('theme-clair');
	} else if (defaultThemeValue === '1') {
		document.documentElement.classList.add('theme-sombre');
	} else if (defaultThemeValue === '2') {
		document.documentElement.classList.add('theme-noir');
	} else if (defaultThemeValue === '3') {
		document.documentElement.classList.add('theme-neon');
	} else if (theme === '4') {
		document.documentElement.classList.add('theme-grie');
	} else if (theme === '5') {
		document.documentElement.classList.add('theme-orange');
	}

	// Appeler la fonction pour les éléments avec l'ID #x-theme
	addClickEvent('x-theme');
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
