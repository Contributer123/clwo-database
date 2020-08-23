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

$cmd_request_state_sixty_minutes = "SELECT ShortName, MapDisplayName, COUNT(MapDisplayName) FROM `snapshots` WHERE ClientCount > 5  GROUP BY MapDisplayName, ShortName HAVING COUNT(MapDisplayName) > 180 ORDER BY ShortName, COUNT(MapDisplayName) DESC";
$request_states_sixty = $conn->query($cmd_request_state_sixty_minutes);
$req["data"] = json_encode($request_states_sixty->fetch_all());

echo json_encode($req);


?>