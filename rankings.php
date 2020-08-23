<!DOCTYPE HTML>
<html>
<head>  
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<style>
	
	#messages > div {
		font-size: 17px;
		font-family: cursive;
	}
	.title_map  {
		display: grid;
		background: red;
	}
	.canvas_container {
		height: 300px;
		margin: 20px;
	}
	.canvas_container > div {
		 position: relative;
 height: 300px;
	}
	.canvas_container > div > canvas {
		 position: absolute;
 width: 100%;
 height: 300px;
	}
	
	</style>
<script>
window.onload = function () {
}
</script>
</head>
<body>
	<div class="section blue lighten-5" id="index-banner">
    <div class="container">
      <h1 class="header center blue-text">Map Statistics</h1>
      <div class="row center">  
      </div>

    </div>
  </div>
  
<div id="messages" class="blue lighten-5" ></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(~0);

$conn = mysqli_connect("localhost", "root", "!CLWOSafe123", "clwo_server");
if (!$conn) {
    echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
    echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo "Database Connection Etablished" . PHP_EOL;
echo "Host-Informationen: " . mysqli_get_host_info($conn) . PHP_EOL;
echo "<br>";

$cmd_request_state_sixty_minutes = "SELECT ShortName, MapDisplayName, COUNT(MapDisplayName) FROM `snapshots` WHERE ClientCount > 5  GROUP BY MapDisplayName, ShortName HAVING COUNT(MapDisplayName) > 180 ORDER BY ShortName, COUNT(MapDisplayName) DESC";
$request_states_sixty = $conn->query($cmd_request_state_sixty_minutes);

foreach($request_states_sixty->fetch_all() as $requests_info){
 // print_r($value);// "Salary: $value<br>";
  echo "<div style='color:green;'>ShortName: ". $requests_info[0]." MapDisplayName: ".. $requests_info[1];
  $playtime = round(floor((int)$requests_info[1])/ (60), 2);
  echo "Playtime : <b>".$playtime."%</b></div>";
  
}
?>