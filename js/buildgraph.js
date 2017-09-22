var liftxaxis = ["January", "February", "March", "April", "May", "June", "July"];
var liftyaxis = [155, 165, 160, 170, 175, 175, 185]

function buildliftChart() {
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: liftxaxis,
        datasets: [{
            label: "Bench Press",
            backgroundColor: 'rgb(231,76,60)',
            borderColor: 'rgb(231,76,60)',
            data: liftyaxis,
        }]
    },

    // Configuration options go here
    options: {}
});
}

buildliftChart();

document.getElementById("saveLift").onclick = function() {
	let weight = document.getElementById("weightInput").value;
	let reps = document.getElementById("repsInput").value;
	let type = document.getElementById("typeInput").value;
	let date = document.getElementById("dateInput").value;
	liftxaxis.push(date);
	liftyaxis.push(weight);
	buildliftChart();

}

var weightxaxis = ["January", "February", "March"];
var weightyaxis = [178, 172, 171, 170]

function buildweightChart() {
	var ctx = document.getElementById('bodyweightChart').getContext('2d');
	var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: weightxaxis,
        datasets: [{
            label: "Body Weight",
            backgroundColor: 'rgb(231,76,60)',
            borderColor: 'rgb(231,76,60)',
            data: weightyaxis,
        }]
    },

    // Configuration options go here
    options: {}
});
}

buildweightChart();

document.getElementById("add").onclick = function() {
	let date = "April";
	let bodyweight = document.getElementById("newBodyWeight");
	weightxaxis.push(date);
	weightyaxis.push(bodyweight);
	buildweightChart();

}