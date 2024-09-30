function enableButton() {
	var dateDayInput = document.getElementById("dateDay");
	if (dateDayInput) {
		document.getElementById("ButtonSearch").removeAttribute("disabled");
	}
}

$(document).ready(function () {
	// État initial
	$(".arrosagesHisto, .alertesHisto, .modifArrosagesHisto, .modifAlertesHisto, .modifTolerancesHisto, .modifHorairesHisto").hide();
	// Supprimer la classe ongletSelect de tous les onglets
	$(".onglet").removeClass("ongletSelect");

	// par défaut
	$(".mesuresHisto").show();
	$("#onglet1").addClass("ongletSelect");

	// Événement de clic sur l'onglet
	$(".onglet").click(function () {
		// Cacher toutes les divs
		$(".mesuresHisto, .arrosagesHisto, .alertesHisto, .modifArrosagesHisto, .modifAlertesHisto, .modifTolerancesHisto, .modifHorairesHisto").hide();
		// Supprimer la classe ongletSelect de tous les onglets
		$(".onglet").removeClass("ongletSelect");

		// Afficher la division correspondante en fonction de l'onglet cliqué
		switch ($(this).attr("id")) {
			case "onglet1":
				$(".mesuresHisto").show();
				$("#onglet1").addClass("ongletSelect");
				break;
			case "onglet2":
				$(".arrosagesHisto").show();
				$("#onglet2").addClass("ongletSelect");
				break;
			case "onglet3":
				$(".alertesHisto").show();
				$("#onglet3").addClass("ongletSelect");
				break;
			case "onglet4":
				$(".modifArrosagesHisto").show();
				$("#onglet4").addClass("ongletSelect");
				break;
			case "onglet5":
				$(".modifAlertesHisto").show();
				$("#onglet5").addClass("ongletSelect");
				break;
			case "onglet6":
				$(".modifTolerancesHisto").show();
				$("#onglet6").addClass("ongletSelect");
				break;
			case "onglet7":
				$(".modifHorairesHisto").show();
				$("#onglet7").addClass("ongletSelect");
				break;
			default:
				break;
		}
	});
});

document.querySelector('.onglets-nav').addEventListener('wheel', function(e) {
 	e.preventDefault();
	const delta = e.deltaY || e.detail || e.wheelDelta;
	this.scrollLeft += delta;
});

const ongletsNav = document.querySelector('.onglets-nav');
const scrollLeftBtn = document.querySelector('.scroll-left');
const scrollRightBtn = document.querySelector('.scroll-right');

scrollLeftBtn.addEventListener('click', function() {
	ongletsNav.scrollLeft -= 1000;
});

scrollRightBtn.addEventListener('click', function() {
	ongletsNav.scrollLeft += 1000;
});
