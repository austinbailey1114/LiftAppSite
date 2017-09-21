var xaxis = ["January", "February", "March", "April", "May", "June", "July"];
	var yaxis = [155, 165, 160, 170, 175, 175, 185]

	function buildChart() {
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
	    // The type of chart we want to create
	    type: 'line',

	    // The data for our dataset
	    data: {
	        labels: xaxis,
	        datasets: [{
	            label: "Bench Press",
	            backgroundColor: 'rgb(231,76,60)',
	            borderColor: 'rgb(231,76,60)',
	            data: yaxis,
	        }]
	    },

	    // Configuration options go here
	    options: {}
	});
	}

	buildChart();

	document.getElementById("saveLift").onclick = function() {
		let weight = document.getElementById("weightInput").value;
		let reps = document.getElementById("repsInput").value;
		let type = document.getElementById("typeInput").value;
		buildChart();

	}