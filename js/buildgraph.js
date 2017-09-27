function buildliftChart() {
    //get title
    var e = document.getElementById("chooseLiftToDisplay");
    var titleString = e.options[e.selectedIndex].text;
    titleString = titleString.replace(/ /g, "_");

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
            borderColor: 'rgb(231,76,60)',
            backgroundColor: 'rgba(231,76,60,0.3',
            fill: true,
            data: yaxis,
            pointBackgroundColor: 'rgb(231,76,60)',

        }]
    },

    // Configuration options go here
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
         },
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
            fill: true,
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




