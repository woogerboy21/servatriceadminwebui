<!DOCTYPE HTML>
<head>
	<title>Servatrice Administrator</title>
	<meta name="author" content="Zach H (ZeldaZach)">
	<style>
		td {text-align:center;}
		a {border-bottom: 1px dashed black; text-decoration:none; color:black;}
	</style>

</head>
<body>
	<?php
		require '.auth_modsession';
		require '.config_commonfunctions';
		global $configfile;
		?>
	<center>
	<form method="POST">
	<table border="1">
		<tr>
			<td style="width:150px">Find By Username</td>
			<td style="width:250px"><input type="text" name="username" placeHolder="Username" value="<?=$_REQUEST['username']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width:150px">Find By IP Address</td>
			<td style="width:250px"><input type="text" name="ip_address" placeHolder="127.0.0.1" value="<?=$_REQUEST['ip_address']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width:150px">Find By Game ID</td>
			<td style="width:250px"><input type="text" name="game_id" placeHolder="Game ID" value="<?=$_REQUEST['game_id']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td style="width:150px">Find By Game Name</td>
			<td style="width:250px"><input type="text" name="game_name" placeHolder="Game Name" value="<?=$_REQUEST['game_name']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td>Log Location</td>
			<td>
				<div style="text-align:left; padding-left:30%">
					<input type="checkbox" name="type_of_chat[0]" value="room">Main Room<br/>
					<input type="checkbox" name="type_of_chat[1]" value="game">Game Rooms<br/>
					<input type="checkbox" name="type_of_chat[2]" value="chat">Private Chat
				</div>
			</td>
		</tr>
		<tr>
			<td>Date Range</td>
			<td>
				<div style="text-align:left; padding-left:30%">
					<input type="radio" name="from_date" value="week">Past 7 days<br/>
					<input type="radio" name="from_date" value="day">Today<br/>
					<input type="radio" name="from_date" value="hour">Last Hour
				</div>
			</td>
		</tr>
		<tr>
			<td style="width:150px">Maximum Results</td>
			<td style="width:250px"><input type="text" name="max_results" placeHolder="Unlimited" value="<?=$_REQUEST['max_results']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td colspan="2" style="width:400px">
				All fields are optional.<br/>The more information you put in, the more specific your results will be.<br/>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="width:400px">
				<input type="submit" value="Get User Logs" style="width:150px">
			</td>
		</tr>
	</table>
	</form>
	<br/><br/>
<?php
if (count($_REQUEST) > 0)
{	
	if (strlen($_REQUEST['username']) > 0) // Check if a username is given
	{
		$username = strtolower(mysql_real_escape_string($_REQUEST['username']));
	}

	if (strlen($_REQUEST['ip_address']) > 0) // Check if IP is given
	{
		$ip_to_find = mysql_real_escape_string($_REQUEST['ip_address']);
	}
	
	if (intval($_REQUEST['game_id'] > 0)) // Check if Game ID is given
	{
		$game_id = intval(mysql_real_escape_string($_REQUEST['game_id']));
	}
	
	if (strlen($_REQUEST['game_name']) > 0) // Check if Game Name is given
	{
		$game_name = mysql_real_escape_string(strtolower($_REQUEST['game_name']));
	}
	
	if ($_REQUEST['from_date']) // Check if date range is given
	{
		$total_time = mysql_real_escape_string($_REQUEST['from_date']);
	}
	
	if (count($_REQUEST['type_of_chat']) > 0) // Check if any specific locations are given
	{
		$get_logs_from = array();
		for ($i = 0; $i < 3; $i++)
		{
			if (isset($_REQUEST['type_of_chat'][$i]))
			{
				$get_logs_from[] = mysql_real_escape_string($_REQUEST['type_of_chat'][$i]);
			}
		}
	}
	
	/* BUILD QUERY BASE */
	$max_results_q = (intval($_REQUEST['max_results']) > 0) ? "LIMIT 0," . intval($_REQUEST['max_results']) : "";
	$user_q = (isset($username)) ? "AND (`sender_name` = '$username' OR `target_name` = '$username')" : "";
	$ip_q = isset($ip_to_find) ? "AND `sender_ip` = '$ip_to_find'" : "";
	$game_id_q = isset($game_id) ? "AND (`target_id` = '$game_id' AND `target_type` = 'game')" : "";
	$game_name_q = isset($game_name) ? "AND (`target_name` = '$game_name' AND `target_type` = 'game')" : "";

	switch ($total_time)
	{	
		case "week":
			$date_q = "AND `log_time` >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
		break;
			
		case "day":
			$date_q = "AND `log_time` >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
		break;
		
		case "hour":
			$date_q = "AND `log_time` >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
		break;
		
		default:
			$date_q = "";
		break;
	}

	// Print out the tables, but in the format: Room, Game, Chat (3 different tables) based on what's requested
	if (count($get_logs_from) == 0 && !isset($game_id) && !isset($game_name)) // Default: Show all 3 Tables
	{
		$get_logs_from = array("room", "game", "chat");
	}
	else if (isset($game_id) || isset($game_name)) // If getting a game room log, must change it to just show game room
	{
		$get_logs_from = array("game");
	}

	for ($i = 0; $i < count($get_logs_from); $i++)
	{
		$target_type_q = (strlen($game_id_q) == 0) ? "AND `target_type` = '{$get_logs_from[$i]}'" : ""; // Builds target query and avoids issues
		$query = mysql_query("SELECT * FROM `cockatrice_log` WHERE `sender_ip` IS NOT NULL $user_q $date_q $ip_q $game_id_q $target_type_q $game_name_q ORDER BY -log_time $max_results_q") or die(mysql_error());
		
		switch ($get_logs_from[$i])
		{
			case "room":
				echo "<table border=1><tr><th colspan=4>Main Chat Room Logs</th></tr>\n";
				echo "<tr><th width=150px>Sender</th><th width=120px>IP Address</th><th width=300px>Message</th><th width=150px>Time Stamp</th></tr>\n";
				while ($row = mysql_fetch_array($query))
				{
					$username = $row['sender_name'];
					$name_with_link = "<a href='?username=$username'>$username</a>";
					
					$ip = $row['sender_ip'];
					$ip_with_link = "<a href='?ip_address=$ip'>$ip</a>";
					
					echo "<tr><td>$name_with_link</td><td>$ip_with_link</td><td>{$row['log_message']}</td><td>{$row['log_time']}</td></tr>\n";
				}
				echo "</table><br/>\n";
			break;
			
			case "game":
				echo "<table border=1><tr><th colspan=6>Game Chat Logs</th></tr>\n";
				echo "<tr><th width=150px>Sender</th><th width=120px>IP Address</th><th width=300px>Message</th><th width=150px>Game ID</th>";
				echo "<th width=200px>Game Name</th><th width=150px>Time Stamp</th></tr>\n";
				while ($row = mysql_fetch_array($query))
				{
					$username = $row['sender_name'];
					$name_with_link = "<a href='?username=$username'>$username</a>";
					
					$ip = $row['sender_ip'];
					$ip_with_link = "<a href='?ip_address=$ip'>$ip</a>";
					
					$room_id = $row['target_id'];
					$room_id_with_link = "<a href='?game_id=$room_id'>$room_id</a>";
					
					$game_name = $row['target_name'];
					$game_name_with_link = "<a href='?game_name=$game_name'>$game_name</a>";
					
					echo "<tr><td>$name_with_link</td><td>$ip_with_link</td><td>{$row['log_message']}</td><td>$room_id_with_link</td><td>$game_name_with_link</td><td>{$row['log_time']}</td></tr>\n";
				}
				echo "</table><br/>\n";
			break;
			
			case "chat":
				echo "<table border=1><tr><th colspan=5>Private Chat Logs</th></tr>\n";
				echo "<tr><th width=150px>Sender</th><th width=120px>IP Address</th><th width=300px>Message</th><th width=200px>Receiver</th><th width=150px>Time Stamp</th></tr>\n";
				while ($row = mysql_fetch_array($query))
				{
					$username = $row['sender_name'];
					$name_with_link = "<a href='?username=$username'>$username</a>";
				
					$ip = $row['sender_ip'];
					$ip_with_link = "<a href='?ip_address=$ip'>$ip</a>";
					
					$receiver = $row['target_name'];
					$receiver_with_link = "<a href='?username=$receiver'>$receiver</a>";
				
					echo "<tr><td>$name_with_link</td><td>$ip_with_link</td><td>{$row['log_message']}</td><td>$receiver_with_link</td><td>{$row['log_time']}</td></tr>\n";
				}
				echo "</table><br/>\n";
			break;
		}
	}
}
?>
</center>
</body>
</html>