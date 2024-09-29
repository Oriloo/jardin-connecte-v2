<script type="text/javascript">
// Variables pour suivre l'état du clic
var isMouseDown = false;
var slider_update = 0;

// Appeler la fonction au chargement de la page
document.addEventListener('DOMContentLoaded', function () {
	// Appel de la fonction pour mettre à jour les informations des slider
	updateSliderInfo('slider1-1', 'minOutput1-1', 'maxOutput1-1', 'minInput1-1', 'maxInput1-1');
	updateSliderInfo('slider1-2', 'minOutput1-2', 'maxOutput1-2', 'minInput1-2', 'maxInput1-2');
	updateSliderInfo('slider1-3', 'minOutput1-3', 'maxOutput1-3', 'minInput1-3', 'maxInput1-3');
	updateSliderInfo('slider1-4', 'minOutput1-4', 'maxOutput1-4', 'minInput1-4', 'maxInput1-4');
	updateSliderInfo('slider2-1', 'minOutput2-1', 'maxOutput2-1', 'minInput2-1', 'maxInput2-1');
	updateSliderInfo('slider2-2', 'minOutput2-2', 'maxOutput2-2', 'minInput2-2', 'maxInput2-2');
	updateSliderInfo('slider2-3', 'minOutput2-3', 'maxOutput2-3', 'minInput2-3', 'maxInput2-3');
	updateSliderInfo('slider2-4', 'minOutput2-4', 'maxOutput2-4', 'minInput2-4', 'maxInput2-4');
	updateSliderInfo('slider3-1', 'minOutput3-1', 'maxOutput3-1', 'minInput3-1', 'maxInput3-1');
	updateSliderInfo('slider4-1', 'minOutput4-1', 'maxOutput4-1', 'minInput4-1', 'maxInput4-1');

	// Créer un tableau avec les identifiants des sliders
	var sliders = [
	    { id: 'slider1-1', update: 11 },
	    { id: 'slider1-2', update: 12 },
	    { id: 'slider1-3', update: 13 },
	    { id: 'slider1-4', update: 14 },
	    { id: 'slider2-1', update: 21 },
	    { id: 'slider2-2', update: 22 },
	    { id: 'slider2-3', update: 23 },
	    { id: 'slider2-4', update: 24 },
	    { id: 'slider3-1', update: 31 },
	    { id: 'slider4-1', update: 41 }
	];

	// Boucle à travers les sliders pour ajouter les gestionnaires d'événements
	sliders.forEach(function(slider) {
	    var element = document.querySelector('#' + slider.id);
	    element.addEventListener('mousedown', function() {
	        isMouseDown = true;
	        slider_update = slider.update;
	    });
	    element.addEventListener('mouseup', function() {
	        isMouseDown = false;
	        slider_update = 0;
	    });
	});

	// Ajouter un gestionnaire d'événements pour détecter le mouvement de la souris sur l'ensemble du document
	document.addEventListener('mousemove', function () {
		if (isMouseDown) {
			if (slider_update == 11)
				updateSliderInfo('slider1-1', 'minOutput1-1', 'maxOutput1-1', 'minInput1-1', 'maxInput1-1');
			else if (slider_update == 12)
				updateSliderInfo('slider1-2', 'minOutput1-2', 'maxOutput1-2', 'minInput1-2', 'maxInput1-2');
			else if (slider_update == 13)
				updateSliderInfo('slider1-3', 'minOutput1-3', 'maxOutput1-3', 'minInput1-3', 'maxInput1-3');
			else if (slider_update == 14)
				updateSliderInfo('slider1-4', 'minOutput1-4', 'maxOutput1-4', 'minInput1-4', 'maxInput1-4');
			else if (slider_update == 21)
				updateSliderInfo('slider2-1', 'minOutput2-1', 'maxOutput2-1', 'minInput2-1', 'maxInput2-1');
			else if (slider_update == 22)
				updateSliderInfo('slider2-2', 'minOutput2-2', 'maxOutput2-2', 'minInput2-2', 'maxInput2-2');
			else if (slider_update == 23)
				updateSliderInfo('slider2-3', 'minOutput2-3', 'maxOutput2-3', 'minInput2-3', 'maxInput2-3');
			else if (slider_update == 24)
				updateSliderInfo('slider2-4', 'minOutput2-4', 'maxOutput2-4', 'minInput2-4', 'maxInput2-4');
			else if (slider_update == 31)
				updateSliderInfo('slider3-1', 'minOutput3-1', 'maxOutput3-1', 'minInput3-1', 'maxInput3-1');
			else if (slider_update == 41)
				updateSliderInfo('slider4-1', 'minOutput4-1', 'maxOutput4-1', 'minInput4-1', 'maxInput4-1');
		}
	});

	// Ajouter un gestionnaire d'événements pour détecter le clic même en dehors de la zone du slider
	document.addEventListener('mouseup', function () {
		isMouseDown = false;
		slider_update = 0;
	});
});

// Fonction générique pour mettre à jour les informations du slider
function updateSliderInfo(sliderId, minOutputId, maxOutputId, minInputId, maxInputId) {
	// Sélectionnez le div avec l'id "slider"
    var slider = document.getElementById(sliderId);

	// Sélectionnez l'élément avec l'attribut aria-valuenow
    var lowerThumb = slider.querySelector('[data-lower]');
    var upperThumb = slider.querySelector('[data-upper]');

	// Récupérez la valeur aria-valuenow
    var lowerValue = lowerThumb.getAttribute('aria-valuenow');
    var upperValue = upperThumb.getAttribute('aria-valuenow');

	// Sélectionnez la balise div avec la classe "sliderOutput"
    var minOutput = document.querySelector('#' + minOutputId);
    var maxOutput = document.querySelector('#' + maxOutputId);

	// Sélectionnez l'input avec l'id "hiddenInput"
    var minInput = document.querySelector('#' + minInputId);
    var maxInput = document.querySelector('#' + maxInputId);

    if (sliderId == 'slider3-1') {
		// Calcule des valeurs
		var hValue31 = Math.floor((parseInt(lowerValue) * 15) / 60);
		var mValue31 = (parseInt(lowerValue) * 15) % 60;

		// Mettez à jour le contenu de la balise div avec les valeurs
		minOutput.textContent = hValue31;
		maxOutput.textContent = mValue31;

    } else {
		// Mettez à jour le contenu de la balise div avec les valeurs
	    minOutput.textContent = lowerValue;
	    maxOutput.textContent = upperValue;
    }

    // Mettez à jour la valeur de l'input hidden
	minInput.value = lowerValue;
	maxInput.value = upperValue;
}
</script>
