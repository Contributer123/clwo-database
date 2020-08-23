
<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


$conn = mysqli_connect("localhost", "root", "!CLWOSafe123", "clwo_server");

if (!$conn) {

    echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;

    echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;

    echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;

    exit;

}

echo "Database Connection Etablished" . PHP_EOL;

echo "Host-Informationen: " . mysqli_get_host_info($conn) . PHP_EOL;


$date = date_create();

$json = file_get_contents('https://clwo.eu/jailbreak/api/v2/livechat.php?Timestamp=0');

$obj = json_decode($json, true);

$msg = "INSERT INTO `chatlogs` (`ID`, `AccountID`, `Nickname`, `ChatType`, `Message`, `Team`, `ToAccountID`, `Timestamp`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";




$complete_sql_command = "";

foreach($obj['Chatlog'] as $msg_info)

{

	

	$data = [];

	$data["ID"] = $msg_info["ID"]; 

	$data["AccountID"] = $msg_info["AccountID"]; 

	$data["Nickname"] = $msg_info["Nickname"];

	$data["ChatType"] = $msg_info["ChatType"];

	$data["Message"] = $msg_info["Message"];

	$data["Team"] = $msg_info["Team"];

	$data["ToAccountID"] = $msg_info["ToAccountID"];

	$data["Timestamp"] = $msg_info["Timestamp"];

	

	if (!($stmt = $conn->prepare($msg))) {

		echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;

	}

		mysqli_stmt_bind_param($stmt, 'ssssssss', $msg_info['ID'], $msg_info['AccountID'], $msg_info['Nickname'], $msg_info['ChatType'],$msg_info['Message'],  $msg_info['Team'], $msg_info['ToAccountID'], $msg_info['Timestamp'] );

    mysqli_stmt_execute($stmt);

}

mysqli_close($conn);



?>

