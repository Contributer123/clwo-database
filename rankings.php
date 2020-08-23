<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
     
     
</head>
<body>
  <div class="section blue lighten-5" id="index-banner">
    <div class="container">
      <h1 class="header center blue-text">Map Rankings </h1>
    </div>
  </div>


  <div class="blue lighten-5">
    <div class="section">
      <div class="row">
      
        <div class="col xl3 l4 m6 s12">
          <div class="icon-block">
            
            <h5 class="center">
              <span class="center light-blue-text">
                <i class="material-icons">trending_up</i>
              </span>
              <span>Jailbreak</span>
            </h5>
            
              <ul class="collection" id="ranking_jailbreak">
              </ul>
              
          </div>
        </div>      
      
        <div class="col xl3 l4 m6 s12">
          <div class="icon-block">
          
            <h5 class="center">
              <span class="center light-blue-text">
                <i class="material-icons">trending_up</i>
              </span>
              <span>Top Traitor</span>
            </h5>          

            <ul class="collection" id="most_killed_ranking">
            </ul>
            
              </div>
        </div>

        <div class="col xl3 l4 m6 s12">
          <div class="icon-block">
            <h5 class="center">
              <span class="center light-blue-text">
                <i class="material-icons">search</i>
              </span>
              <span>Scanned bodies</span>
            </h5>      
            
            <ul class="collection" id="identified_bodies_ranking">
            </ul>

          </div>
        </div>
        
      </div>
    </div>
    <br><br>
  </div>

  <footer class="page-footer blue">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="https://steamcommunity.com/id/IAmFat__/" target="_blank">IAmFat</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
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
  echo "<div style='color:green;'>ShortName: ". $requests_info[0]." MapDisplayName: ". $requests_info[1];
  $playtime = round(floor((int)$requests_info[2])/ 60, 0);
  echo "Playtime : <b>".$playtime." Hours</b></div>";
  
}
?>