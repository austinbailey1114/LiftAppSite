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
            borderColor: 'rgb(231,76,60)',
            fill: false,
            data: liftyaxis,
        }]
    },

    // Configuration options go here
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
}

buildliftChart();

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
            fill: false,
            borderColor: 'rgb(231,76,60)',
            data: weightyaxis,
        }]
    },

    // Configuration options go here
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
}

buildweightChart();




