<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {

	// Récupérer l'élément select
    var selectElement2 = document.getElementById("select-SI2");
    var selectElement3 = document.getElementById("select-SI3");
    var selectElement4 = document.getElementById("select-SI4");

    // Définir les valeurs par défaut pour chaque select
    selectElement2.value = humaSI12;
    selectElement3.value = humsSI13;
    selectElement4.value = lumiSI14;

	RangeSliderSI1();
	RangeSliderSI2();
	RangeSliderSI3();
	RangeSliderSI4();
});

/***** Seuils de déclenchement de l'arrosage *****/
var temp11min = <?php echo $last_temp_min_d; ?>;
var temp11max = <?php echo $last_temp_max_d; ?>;
var huma12 = <?php echo $last_huma_d; ?>;
var hums13 = <?php echo $last_hums_d; ?>;
var lumi14 = <?php echo $last_lumi_d; ?>;
var humaSI12 = <?php echo $last_huma_si; ?>;
var humsSI13 = <?php echo $last_hums_si; ?>;
var lumiSI14 = <?php echo $last_lumi_si; ?>;

function RangeSliderSI1() {
	rangeSlider(document.querySelector('#slider1-1'), {
		step: 1,
		min: 0,
		max: 40,
		value: [temp11min, temp11max]
	})

	// Appel de la fonction pour mettre à jour les informations du slider
	updateSliderInfo('slider1-1', 'minOutput1-1', 'maxOutput1-1', 'minInput1-1', 'maxInput1-1');
}

function RangeSliderSI2() {
	// Récupérer l'élément select
	var selectElement2 = document.getElementById("select-SI2");

	// Récupérer la valeur sélectionnée
	var selectedValue2 = selectElement2.value;

	// cacher les span
	$('#maxOutput1-2').hide();
	$('#minOutput1-2').hide();

	if (selectedValue2 == 1) {
		rangeSlider(document.querySelector('#slider1-2'), {
			step: 1,
			value: [0, huma12],
			thumbsDisabled: [true, false],
			rangeSlideDisabled: true
		})
		// afficher le span max
		$('#maxOutput1-2').show();
	} else {
		rangeSlider(document.querySelector('#slider1-2'), {
			step: 1,
			value: [huma12, 100],
			thumbsDisabled: [false, true],
			rangeSlideDisabled: true
		})
		// afficher le span min
		$('#minOutput1-2').show();
	}

	// Appel de la fonction pour mettre à jour les informations du slider
	updateSliderInfo('slider1-2', 'minOutput1-2', 'maxOutput1-2', 'minInput1-2', 'maxInput1-2');
}

function RangeSliderSI3() {
	// Récupérer l'élément select
	var selectElement3 = document.getElementById("select-SI3");

	// Récupérer la valeur sélectionnée
	var selectedValue3 = selectElement3.value;

	// cacher les span
	$('#maxOutput1-3').hide();
	$('#minOutput1-3').hide();

	if (selectedValue3 == 1) {
		rangeSlider(document.querySelector('#slider1-3'), {
			step: 1,
			value: [0, hums13],
			thumbsDisabled: [true, false],
			rangeSlideDisabled: true
		})
		// afficher le span max
		$('#maxOutput1-3').show();
	} else {
		rangeSlider(document.querySelector('#slider1-3'), {
			step: 1,
			value: [hums13, 100],
			thumbsDisabled: [false, true],
			rangeSlideDisabled: true
		})
		// afficher le span min
		$('#minOutput1-3').show();
	}

	// Appel de la fonction pour mettre à jour les informations du slider
	updateSliderInfo('slider1-3', 'minOutput1-3', 'maxOutput1-3', 'minInput1-3', 'maxInput1-3');
}

function RangeSliderSI4() {
	// Récupérer l'élément select
	var selectElement4 = document.getElementById("select-SI4");

	// Récupérer la valeur sélectionnée
	var selectedValue4 = selectElement4.value;

	// cacher les span
	$('#maxOutput1-4').hide();
	$('#minOutput1-4').hide();

	if (selectedValue4 == 1) {
		rangeSlider(document.querySelector('#slider1-4'), {
			min: 0,
			max: 5,
			step: 1,
			value: [1, lumi14],
			thumbsDisabled: [true, false],
			rangeSlideDisabled: true
		})
		// afficher le span max
		$('#maxOutput1-4').show();
	} else {
		rangeSlider(document.querySelector('#slider1-4'), {
			min: 0,
			max: 5,
			step: 1,
			value: [lumi14, 5],
			thumbsDisabled: [false, true],
			rangeSlideDisabled: true
		})
		// afficher le span min
		$('#minOutput1-4').show();
	}

	// Appel de la fonction pour mettre à jour les informations du slider
	updateSliderInfo('slider1-4', 'minOutput1-4', 'maxOutput1-4', 'minInput1-4', 'maxInput1-4');
}

/***** Seuils de déclenchement de l'alertes *****/
var temp21min = <?php echo $last_temp_min; ?>;
var temp21max = <?php echo $last_temp_max; ?>;
var huma22min = <?php echo $last_huma_min; ?>;
var huma22max = <?php echo $last_huma_max; ?>;
var hums23min = <?php echo $last_hums_min; ?>;
var hums23max = <?php echo $last_hums_max; ?>;
var lumi24min = <?php echo $last_lumi_min; ?>;
var lumi24max = <?php echo $last_lumi_max; ?>;

rangeSlider(document.querySelector('#slider2-1'), {
	step: 1,
	min: -10,
	max: 50,
	value: [temp21min, temp21max],
})
rangeSlider(document.querySelector('#slider2-2'), {
	step: 1,
	value: [huma22min, huma22max]
})
rangeSlider(document.querySelector('#slider2-3'), {
	step: 1,
	value: [hums23min, hums23max]
})
rangeSlider(document.querySelector('#slider2-4'), {
	step: 1,
	min: 0,
	max: 5,
	value: [lumi24min, lumi24max]
})

/***** Tolérance des seuils *****/
var tolerance31 = <?php echo $last_tole_t; ?>

rangeSlider(document.querySelector('#slider3-1'), {
	step: 1,
	min: 1,
	max: 6,
	thumbsDisabled: [false, true],
	rangeSlideDisabled: true,
	value: [tolerance31, 6]
})

/***** Plage horaire de l'arrosage *****/
var horaire41min = <?php echo $last_minh_h; ?>;
var horaire41max = <?php echo $last_maxh_h; ?>;

rangeSlider(document.querySelector('#slider4-1'), {
	step: 1,
	min: 0,
	max: 24,
	value: [horaire41min, horaire41max]
})
</script>
