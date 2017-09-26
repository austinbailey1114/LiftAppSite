<?
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liftapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//user=1 filters out only your lifts
$sql = "SELECT * FROM lifts WHERE user = 1 AND type= $_POST['chooseLiftToDisplay']";
$result = mysqli_query($conn, $sql);

$lifts = array();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"] . " - weight: " . $row["weight"] . " - reps: " . $row["reps"] . "<br>";
        $lifts[] = $row;
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
echo json_encode($lifts);
//test comment to see if this stays
?>

<script type="text/javascript">
	<?php 
		$liftxaxis = array();
		$liftyaxis = array();

		foreach ($lifts as $lift) {
			$date = strtotime($lift["date"]);
			$liftxaxis[] = date("m-d", $date);

			$weight = $lift["weight"];
			$reps = $lift["reps"];
			$onerepmax = $weight * (1 + ($reps/30));
			$liftyaxis[] = $onerepmax;
		}
	 ?>
	 var liftxaxis = <?php echo json_encode($liftxaxis) ?>;
	 var liftyaxis = <?php echo json_encode($liftyaxis) ?>;

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
</script>

