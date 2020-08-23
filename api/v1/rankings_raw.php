<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(~0);

$conn = mysqli_connect("localhost", "root", "!CLWOSafe123", "clwo_server");
$req = [];

if (!$conn) {
  $req["succeeded"] = false;
  $req["error"] = "Debug-Fehlernummer: " . mysqli_connect_errno() . mysqli_connect_error();
  $req["data"] = "";
  echo json_encode($req);
  exit;
}

$req["succeeded"] = true;
$req["error"] = "";

$cmd_request_state_sixty_minutes = "SELECT ShortName, MapDisplayName, COUNT(MapDisplayName) FROM `snapshots` WHERE ClientCount > 5  AND EntryTime > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1440 minute) GROUP BY MapDisplayName, ShortName HAVING COUNT(MapDisplayName) > 1 ORDER BY ShortName, COUNT(MapDisplayName) DESC";
$request_states_sixty = $conn->query($cmd_request_state_sixty_minutes);

$map_stats = [];
foreach($request_states_sixty->fetch_all() as $requests_info){
  $playtime = round(floor((int)$requests_info[2])/ 60, 2);

  $map_stats[] = array("ShortName" => $requests_info[0], "MapDisplayName" => $requests_info[1], "PlayTime" => $playtime);
}




$req["data"] = json_encode($map_stats);

echo json_encode($req);


?>