<script type="text/javascript">
$(function () {
	function createHighchart(containerId, titres, datas, heures, minY, maxY) {
		var CSSelementColor = "#FFFFFF";
		var CSSgreenElement = "#078450";

		$('#' + containerId).highcharts({
			chart: {
				backgroundColor: 'transparent',
				type: 'column'
			},
			title: {
				text: titres,
				style: {
					color: CSSelementColor
				}
			},
			credits: {
				enabled: false
			},
			legend: {
				enabled: false
			},
			xAxis: {
				categories: heures.map(function (time) {
					return time.substring(0, 5);
				}),
				labels: {
					step: 12,
					rotation: 0.1, // Si c'est à 0, ça bug
				}
			},
			yAxis: {
				title: {
					text: false
				},
				min: minY,
				max: maxY
			},
			tooltip: {
				formatter: function () {
					return 'Heure : ' + this.x + '<br>Valeur : ' + this.y;
				}
			},
			plotOptions: {
				column: {
					borderWidth: 0,
					borderColor: CSSgreenElement
				}
			},
			series: [{
				data: datas,
				color: CSSgreenElement
			}]
		});
	}

	<?php $nbGrapheDirect = 100; ?>

	var heureTD = [<?php
		for ($i = 0; $i < $nbGrapheDirect; $i++) {
			echo "'" . (isset($TDtime[$i]) ? $TDtime[$i] : '00:00') . "'";
			echo ($i < ($nbGrapheDirect - 1)) ? ',' : '';
		}
		?>];

	var tempTD = [<?php
		for ($i = 0; $i < $nbGrapheDirect; $i++) {
			echo isset($TDtemp[$i]) ? $TDtemp[$i] : '0.0';
			echo ($i < ($nbGrapheDirect - 1)) ? ',' : '';
		}
		?>];

	var humaTD = [<?php
		for ($i = 0; $i < $nbGrapheDirect; $i++) {
			echo isset($TDhuma[$i]) ? $TDhuma[$i] : '0.0';
			echo ($i < ($nbGrapheDirect - 1)) ? ',' : '';
		}
		?>];

	var humsTD = [<?php
		for ($i = 0; $i < $nbGrapheDirect; $i++) {
			echo isset($TDhums[$i]) ? $TDhums[$i] : '0.0';
			echo ($i < ($nbGrapheDirect - 1)) ? ',' : '';
		}
		?>];

	var lumiTD = [<?php
		for ($i = 0; $i < $nbGrapheDirect; $i++) {
			echo isset($TDlumi[$i]) ? $TDlumi[$i] : '0.0';
			echo ($i < ($nbGrapheDirect - 1)) ? ',' : '';
		}
		?>];

	createHighchart('containerTempTD', 'Température de l\'Air (°C)', tempTD, heureTD, -10, 50);
	createHighchart('containerHumATD', 'Humidité de l\'Air (%)', humaTD, heureTD, 0, 100);
	createHighchart('containerHumSTD', 'Humidité du Sol (%)', humsTD, heureTD, 0, 100);
	createHighchart('containerLumiTD', 'Niveaux de Luminosité', lumiTD, heureTD, 1, 5);
});
</script>
