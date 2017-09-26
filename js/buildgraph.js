function buildliftChart() {
    //get title
    var e = document.getElementById("chooseLiftToDisplay");
    var titleString = e.options[e.selectedIndex].text;

    var xaxis = new Array();
    var yaxis = new Array();

    for (var i = 0; i < types.length; i++) {
        if (types[i] == titleString) {
            xaxis.push(liftxaxis[i]);
            yaxis.push(liftyaxis[i]);
        }
    }
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: xaxis,
        datasets: [{
            label: titleString,
            borderColor: 'rgb(231,76,60)',
            fill: false,
            data: yaxis,

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




