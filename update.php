<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
$conn = mysqli_connect("localhost", "root", "!CLWOSafe123", "clwo_server"); if (!$conn) {
    echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
    echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo "Database Connection Etablished" . PHP_EOL; echo "Host-Informationen: " . 
mysqli_get_host_info($conn) . PHP_EOL; $command_to_Execute = "INSERT INTO `snapshots` (`ID`, 
`ServerID`, `ShortName`, `ClientCount`, `PlayerOnlineID`, `StaffOnline`, `WardenAccountID`, 
`MapDisplayName`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);"; /* Prepared statement, stage 1: prepare */ 
if (!($stmt = $conn->prepare($command_to_Execute))) {
   echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}
$json = file_get_contents('https://clwo.eu/jailbreak/api/v2/networkquery.php'); $obj = 
json_decode($json, true); echo "Ratelimit:". $obj['ratelimit'].PHP_EOL; echo "<pre>"; 
foreach($obj['data'] as $server_info) {
	
	$data = [];
	$data['ServerID'] = $server_info['ServerID'];
	$data['ShortName'] = $server_info['ShortName'];
	$data['ClientCount'] = $server_info['ClientCount'];
	$data['MapDisplayName'] = $server_info['MapDisplayName'];
	
	$data['StaffOnline'] = isset($server_info['qrd']['rules']['staff']) ?  
  $server_info['qrd']['rules']['staff'] : "";
	$data['WardenAccountID'] = isset($server_info['qrd']['rules']['WardenAccountID']) ? 
  $server_info['qrd']['rules']['WardenAccountID'] : "";;
	
	// Now call additional API to get playerinfo of the players online
	$player_api_url = "https://clwo.eu/jailbreak/api/v2/players.php?SID=".$data['ServerID'];
	$player_api_data = json_decode(file_get_contents($player_api_url), true);
	$list_player_info = [];
	foreach($player_api_data['data'] as $playerinfo)
	{
	  array_push($list_player_info, $playerinfo['AccountID']);
	}
	$data['PlayerOnlineID'] = json_encode($list_player_info);
	
	mysqli_stmt_bind_param($stmt, 'sssssss', $data['ServerID'], $data['ShortName'], 
$data['ClientCount'], $data['PlayerOnlineID'],$data['StaffOnline'], $data['WardenAccountID'], 
$data['MapDisplayName'] );
    mysqli_stmt_execute($stmt);
	
	
	
	print_r($data);
}
mysqli_close($conn); ?>
