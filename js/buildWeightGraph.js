var xaxis = ["January", "February", "March"];
var yaxis = [178, 172, 171, 170]

function buildChart() {
	var ctx = document.getElementById('bodyweightChart').getContext('2d');
	var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: xaxis,
        datasets: [{
            label: "Body Weight",
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

document.getElementById("add").onclick = function() {
	buildChart();

}