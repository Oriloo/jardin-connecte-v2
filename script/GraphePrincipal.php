<script type="text/javascript">
$(function () {
	function createHighchart(containerId, titleText, yAxisText, types, couleurs, datetime, data, yAxisMin, yAxisMax) {
		$('#' + containerId).highcharts({
			chart: {
				backgroundColor: 'transparent',
				type: types
			},
			credits: {
				enabled: false
			},
			legend: {
				enabled: false
			},
			title: {
				text: titleText,
				style: {
					color: CSSelementColor
				}
			},
			xAxis: {
				categories: datetime,
				labels: {
					formatter: function () {
						return Highcharts.dateFormat('%e %b %y', new Date(this.value));
					},
				},
				// Utilisez une fonction pour obtenir les positions des ticks désirées
				tickPositions: getDesiredTickPositions(datetime),
			},
			yAxis: {
				title: {
					text: false
				},
				labels: {
					formatter: function () {
						return this.value + yAxisText;
					}
				},
                min: yAxisMin,
                max: yAxisMax
			},
			tooltip: {
				formatter: function () {
					return this.y + yAxisText 
					+ '<br>Date : ' 
					+ Highcharts.dateFormat('%e %b %Y', new Date(this.x)) 
					+ '<br>Heure : ' 
					+ Highcharts.dateFormat('%H:%M', new Date(this.x));
				}
			},
			plotOptions: {
				line: { marker: { enabled: false }},
				area: { marker: { enabled: false }}
			},
			series: [{
				data: data,
				color: couleurs
			}]
		});
	}

	var dates = <?php echo json_encode($Date); ?>;
	var times = <?php echo json_encode($Time); ?>;
	// Fusionnez les dates et les heures pour former des chaînes de date complètes
	var combinedDateTime = [];
	for (var i = 0; i < dates.length; i++) {
	    var dateTime = new Date(dates[i] + " " + times[i]);
	    // Ajoutez une heure à chaque date et heure combinées
	    dateTime.setHours(dateTime.getHours() + 1);
	    combinedDateTime.push(dateTime.toISOString());
	}

	createHighchart(
		'container1',
		'Température de l\'air',
		'°C',
		'',
		'#FFBF00',
		combinedDateTime,
		<?php echo json_encode($TemA); ?>,
		-10,
		50
	);

	createHighchart(
		'container2',
		'Humidité de l\'air',
		'%',
		'',
		'#FFBF00',
		combinedDateTime,
		<?php echo json_encode($HumA); ?>,
		0,
		100
	);

	createHighchart(
		'container3',
		'Humidité du sol',
		'%',
		'',
		'#FFBF00',
		combinedDateTime,
		<?php echo json_encode($HumS); ?>,
		0,
		100
	);

	createHighchart(
		'container4',
		'Niveaux de Luminosité',
		'',
		'',
		'#FFBF00',
		combinedDateTime,
		<?php echo json_encode($Lumi); ?>,
		1,
		5
	);

	function getDesiredTickPositions(categories) {
		// Choisissez les indices des dates que vous souhaitez afficher
		<?php
		$nbDate = count($Date);
		?>
		var desiredIndexes = [<?php
				for ($i = 0; $i < 9; $i++)
					echo intval($i*($nbDate/8)).", ";
				?>];

		// Obtenez les positions des ticks correspondantes
		var tickPositions = desiredIndexes.map(function(index) {
			return index < categories.length ? index : categories.length - 1;
		});

		return tickPositions;
	}
});
</script>
