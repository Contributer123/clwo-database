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


$cmd_request_state_sixty_minutes = "SELECT ShortName, COUNT(ShortName)  FROM `snapshots` WHERE EntryTime > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1440 minute) GROUP BY ShortName";

$request_states_sixty = $conn->query($cmd_request_state_sixty_minutes);


foreach($request_states_sixty->fetch_all() as $requests_info){

 // print_r($value);// "Salary: $value<br>";

  echo "<div style='color:green;'>Server: ". $requests_info[0]." Uptime Last 24 Hours : ";

  $uptime = round(floor((inT)$requests_info[1]) *100/ (24*60), 2);

  echo "UPTIME : <b>".$uptime."%</b></div>";

  

}

$map_data = [];


$sql = "SELECT MapDisplayName FROM `snapshots` GROUP BY MapDisplayName";

// Do one big SQL Query instead of many small ones 

$big_sql_req = "SELECT ClientCount, EntryTime, MapDisplayName FROM `snapshots` WHERE EntryTime > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 10080 minute) ORDER BY `ServerID` ASC, `EntryTime` DESC, `MapDisplayName` DESC";


$starttime= round(microtime(true) * 1000);


$result = $conn->query($sql);

$big_query = $conn->query($big_sql_req);

$endtime = round(microtime(true) * 1000);


echo "<div>Queries time: ".($endtime - $starttime)."Milliseconds</div>";

//$res_big_query = $big_query->fetch_all();



//print_r($res_big_query);


if ($result->num_rows > 0) {

	$rows_data = $result->fetch_all();

	//$map_data[$row[0]] = [];

	


    //$sql_getmapdetails = "SELECT ServerID, ClientCount, EntryTime FROM `snapshots` WHERE `MapDisplayName` LIKE '". $row[0] ."' ORDER BY `ServerID` ASC, `EntryTime` DESC;";


	//$map_details_result = $conn->query($sql_getmapdetails);

	$time_end = microtime(true);

	

	$starttime= round(microtime(true) * 1000);




	while($detail_row = $big_query->fetch_assoc()) {

	    $map_data[$detail_row["MapDisplayName"]][$detail_row["EntryTime"]] = $detail_row["ClientCount"];

	}


	$endtime = round(microtime(true) * 1000);


	echo "<div>Sorting Data: ".($endtime - $starttime)."Milliseconds</div>";

  

} 

else 

{

  echo "0 results";

}


mysqli_close($conn);


?>

<script>

let parsed_data = <?php echo json_encode($map_data, JSON_HEX_TAG); ?>;

let global_map_data = group_map_data(parsed_data);

let charts_map = [];

smooth_results();

print_data();


function smooth_results()

{

	Object.keys(global_map_data).forEach(function(map_name) 

	{

		for(let i = 0; i < global_map_data[map_name].length; i++) //

		{

			let depthpass_length = 5;

			let previous_values = [];

			let index = 0;

			Object.keys(global_map_data[map_name][i]).forEach(function(time) {

				if(index <= depthpass_length)

				{

					removeA(global_map_data[map_name][i][time], "player_count");

				}

				else

				{

					previous_values.push(global_map_data[map_name][i][time]["player_count"]);

					let players_avg = array_average(previous_values);

					global_map_data[map_name][i][time]["player_count"] = players_avg;

					previous_values.shift();	

				}

				index++;

			});

			

			if(index < 10) // Map has been played less than 10 Minutes, Kick it out

			{

				global_map_data[map_name][i] = [];

			}

		}

	});

}


//console.log(global_map_data);

function array_average(array_containing_values)

{

  let sum = 0;

  let arr_length = array_containing_values.length;

  if(arr_length == 0)

  {

	  return 0;

  }

  

  for(let i = 0; i < arr_length; i++)

  {

	  sum += parseInt(array_containing_values[i]);

  }

  return sum / arr_length;

}


function removeA(arr) {

    var what, a = arguments, L = a.length, ax;

    while (L > 1 && arr.length) {

        what = a[--L];

        while ((ax= arr.indexOf(what)) !== -1) {

            arr.splice(ax, 1);

        }

    }

    return arr;

}


function render_map_data(map_name, number_of_calls) {

	


	start_time = new Date();

	

	let html_element_name = "map_"+map_name;

	if(!(document.getElementById(html_element_name).parentElement.style.display == "none"))

	{

		document.getElementById(html_element_name).parentElement.style.display ="none";

		document.getElementById(html_element_name).parentElement.parentElement.style.color ="";

	}

	else

	{

		document.getElementById(html_element_name).parentElement.style.display ="";

		document.getElementById(html_element_name).parentElement.parentElement.style.color ="blue";	

	}

	

	

	let data_overview = [];

	for(let i = 0; i < global_map_data[map_name].length; i++) //

	{

		

		/*

		html_element_name = "map_"+i+map_name;

		if(!(document.getElementById(html_element_name).parentElement.style.display == "none"))

		{

			document.getElementById(html_element_name).parentElement.style.display ="none";

			document.getElementById(html_element_name).parentElement.parentElement.style.color ="";


			continue;	

		}

		document.getElementById(html_element_name).parentElement.style.display ="";

		document.getElementById(html_element_name).parentElement.parentElement.style.color ="blue";

		*/

		

		let dataset = global_map_data[map_name][i];

		let m_dataPoints = [];


		let day_passed = false;


		


		

		Object.keys(dataset).forEach(function(time) { 

			if(!day_passed)

			{

				let updated_time = new Date(time);

				let passed_hours = updated_time.getHours();

				let passed_minutes = updated_time.getMinutes();

				if(passed_hours == 23 && passed_minutes > 55)

				{

					day_passed = true;

				}

				let timestamp_string ="Thu Jun 04 2020 " + passed_hours + ":" + passed_minutes + ":" + updated_time.getSeconds() + " GMT+0200 (Mitteleuropäische Sommerzeit)";

				let current_value = parseInt(dataset[time]["player_count"]);

				

				m_dataPoints.push({x: new Date(timestamp_string), markerType: "none", y: current_value});

			}

		});		

		data_overview.push({type: "line", dataPoints: m_dataPoints})

			

		charts_map[html_element_name] = new CanvasJS.Chart(html_element_name,

		{

		  title:{

			text: map_name + " : " + (i+1)

		},

		responsive : true,

		axisX:{

			title: "timeline",

			gridThickness: 1

		},

		axisY: {

			title: "Player"

		},

		data: [

		{        

			type: "line",

			dataPoints: m_dataPoints

		}

		]

		});


		charts_map[html_element_name].render();

	}

	charts_map["map_"+map_name] = new CanvasJS.Chart("map_"+map_name,

	{

	  title:{

		text: map_name + " : "

	},

	responsive : true,

	axisX:{

		title: "timeline",

		gridThickness: 1

	},

	axisY: {

		title: "Player"

	},

	data: data_overview

	});

	charts_map["map_"+map_name].render();



	end_time = new Date();

	passed_time = (end_time - start_time);

	console.log("Creating Graphs: " + passed_time + " milliseconds");


}


function print_data() {

	let start_time = new Date();


	// Prepare HTML Page first

	let content = "";

	

	Object.keys(global_map_data).forEach(function(map_name) {

		

		content += "<div class='row ' id='map_container_" + map_name +"'>";

		

		content += "<div class='valign-wrapper col xl2 l3 m4 s5' onclick='render_map_data(\"" + map_name+"\", " + global_map_data[map_name].length +");'>";


		

			content += "<div class='' >" + map_name +"</div>";

			content += "</div>";

			content += "<div class='col xl4 l5 m6 s7'>";

			content += "<img onerror=\"this.src='https://image.gametracker.com/images/maps/160x120/nomap.jpg'\" onclick='render_map_data(\"" + map_name+"\", " + global_map_data[map_name].length +");' id='image_container_" + map_name +"' src='images/" + map_name + ".jpg' id='preview'/>";

			content += "</div>";

			content += "<div class='col xl6 l4 m2 s0' style='height:150px;'></div>";

			

			

			

			let html_element_name = "map_"+map_name; 

			content += "<div class='col xl12 l12 m12 s12' style='display:none;'>";

			content += "<div id='" + html_element_name +"' class='canvas_container'></div>";

			content += "</div>";

		/*

		for(let i = 0; i < global_map_data[map_name].length; i++) //

		{

			html_element_name = "map_"+i+map_name; 

		

			content += "<div class='col xl4 l6 m12 s12' style='display:none;'>";

			content += "<div id='" + html_element_name +"' class='canvas_container'></div>";

			content += "</div>";

			

		}

		*/

		content += "</div>";

	});

	document.getElementById("messages").innerHTML += content;


	let end_time = new Date();

	let passed_time = (end_time - start_time);

	console.log("Creating Struct to fill graphs: " + passed_time + " milliseconds");

}


function group_map_data() {

	let start_time = new Date();

	


	let map_data = {};

	let number_maps = Object.keys(parsed_data).length;

	let time_block = [];


	for(let i=0; i < number_maps; i++)

	{

		let map_name = Object.keys(parsed_data)[i];

		let map_times = parsed_data[map_name];

			

		let time_entries = Object.keys(map_times).length;

		let obj_map_times = Object.keys(map_times).reverse();

		

		let time_block_counter = 0;

		for(let j=0; j < time_entries; j++)

		{

			let timestamp = obj_map_times[j];

			let player_count = map_times[timestamp];

			

			if(j == 0)

			{

				time_block[new Date(timestamp)] = {"player_count" : player_count};

			}

			else

			{

				let prev_timestamp = new Date(obj_map_times[j-1]);

				let curr_timestamp = new Date(timestamp);

				let max_time_distance = 125; // SEconds

				let time_diff = Math.abs(curr_timestamp-prev_timestamp);

				//console.log(prev_timestamp + " - " + curr_timestamp);

				

				if(prev_timestamp == "Invalid Date" || curr_timestamp == "Invalid Date")

				{

					debugger;

				}

				if(time_diff<max_time_distance*1000)

				{

					//console.log("Distance Smaller");

					time_block[curr_timestamp] = {"player_count" : player_count};

				}

				else

				{

					// We have reached a new time block

					// Save the current timeblock

					if(map_data[map_name] == null)

					{

						map_data[map_name] = [];

					}


					map_data[map_name][time_block_counter] = time_block;

					time_block = [];

					time_block[curr_timestamp] = {"player_count" : player_count};

					// increase the counter 

					time_block_counter++;

				}

				// Calculate distance to previous time block

				// If its more than 2 minute, create a new timeblock

			}

		}

		

		if(map_data[map_name] == null)

		{

			map_data[map_name] = [];

		}


		map_data[map_name][time_block_counter] = time_block;

		time_block = [];


		// Now group each data for each map

		// iterate through all timestamps and only count those in the group which are close to it

		// Enumerate those from 1 (first) to n(last)

	}

	let end_time = new Date();

	let passed_time = (end_time - start_time);

	console.log("Converting SQL data into Canvas.js readable format: " + passed_time + " milliseconds");

	return map_data;

}

</script>

