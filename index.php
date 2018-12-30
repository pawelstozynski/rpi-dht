<html>
<head>
	<title>Temperature and humidity</title>

	<script src="./js/Chart.min.js"></script>
	<script src="./js/jquery-3.3.1.min.js"></script>

	<style>
		#left-col {
			width: 75%;
			float: left;
		}
		#right-col {
			width: 25%;
			float: left;
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="left-col">
		<canvas id="myChart"></canvas>
	</div>
	<div id="right-col">
		<h2>Temperature: <span id="temperature"></span>°C</h2>
		<h2>Humidity: <span id="humidity"></span>%</h2>
	</div>

	<script>
		$(document).ready(() => {
			let ctx = document.getElementById("myChart").getContext("2d");

			$.getJSON('./fetchData.php').then(data => {
				let len = data.length;
				let temperatureArr = [];
				let humidityArr = [];
				let timeArr = [];

				data.forEach(x => {
					temperatureArr.push(x.temperature);
					humidityArr.push(x.humidity);
					timeArr.push(x.time);
				});

				$("#temperature").text(temperatureArr[len-1]);
				$("#humidity").text(humidityArr[len-1]);

				let myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: timeArr,
						datasets: [
							{
								label: 'Temperature',
								backgroundColor: 'red',
								borderColor: 'red',
								fill: false,
								data: temperatureArr
							}, {
								label: 'Humidity',
								backgroundColor: 'blue',
								borderColor: 'blue',
								fill: false,
								data: humidityArr
							}
						]
					}
				});
			});

		});
	</script>
</body>
</html>
