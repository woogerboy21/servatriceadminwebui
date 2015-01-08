<!DOCTYPE HTML>
<head>
	<title>Servatrice Administrator</title>
	<meta name="author" content="Zach H (ZeldaZach)">
	<style> td {text-align:center; max-width:300px;} </style>
<?php
	require '.auth_modsession';
	require '.config_commonfunctions';
	
	header("Content-Type: text/html; charset=ISO-8859-1"); // Fixes some characters	

	if ($_REQUEST['submit_filter']) // Clear filters
	{
		die(header("Location: viewlog.php"));
	}

	$checked = array(); // Determine which checkboxes/radio buttons to keep checked
	for ($i = 0; $i < 6; $i++)
	{
		if ($_REQUEST["type_of_chat"][$i])
		{
			$checked[$i] = "checked";
		}
		else if ($_REQUEST["from_date"] == "week")
		{
			$checked[3] = "checked";
		}
		else if ($_REQUEST["from_date"] == "day")
		{
			$checked[4] = "checked";
		}
		else if ($_REQUEST["from_date"] == "hour")
		{
			$checked[5] = "checked";
		}
	}
?>
</head>
<body>
	<center>
	<form method="POST">
	<table border="1">
		<tr>
			<td style="min-width:150px"><a href="portal_servermanagement.php">Server Management Menu</a></td>
            <td style="min-width:250px"><a href="logout.php">Logout</a></td>
		</tr>
		<tr>
			<td style="min-width:150px">Find By Username</td>
			<td style="min-width:250px"><input type="text" name="username" placeHolder="Username" value="<?=$_REQUEST['username']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td style="min-width:150px">Find By IP Address</td>
			<td style="min-width:250px"><input type="text" name="ip_address" placeHolder="127.0.0.1" value="<?=$_REQUEST['ip_address']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td style="min-width:150px">Find By Game ID</td>
			<td style="min-width:250px"><input type="text" name="game_id" placeHolder="Game ID" value="<?=$_REQUEST['game_id']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td style="min-width:150px">Find By Game Name</td>
			<td style="min-width:250px"><input type="text" name="game_name" placeHolder="Game Name" value="<?=$_REQUEST['game_name']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td>Log Location</td>
			<td>
				<div style="text-align:left; padding-left:30%">
					<input type="checkbox" name="type_of_chat[0]" value="room" <?=$checked[0]?> >Main Room<br/>
					<input type="checkbox" name="type_of_chat[1]" value="game" <?=$checked[1]?> >Game Rooms<br/>
					<input type="checkbox" name="type_of_chat[2]" value="chat" <?=$checked[2]?> >Private Chat
				</div>
			</td>
		</tr>
		<tr>
			<td>Date Range</td>
			<td>
				<div style="text-align:left; padding-left:30%">
					<input type="radio" name="from_date" value="week" <?=$checked[3]?> >Past 7 days<br/>
					<input type="radio" name="from_date" value="day" <?=$checked[4]?> >Today<br/>
					<input type="radio" name="from_date" value="hour" <?=$checked[5]?> >Last Hour
				</div>
			</td>
		</tr>
		<tr>
			<td style="min-width:150px">Maximum Results</td>
			<td style="min-width:250px"><input type="text" name="max_results" placeHolder="500" value="<?=$_REQUEST['max_results']?>" style="width:200px; text-align: center;"></td>
		</tr>
		<tr>
			<td colspan="2" style="min-width:400px">
				All fields are optional.<br/>The more information you put in, the more specific your results will be.<br/>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="min-width:400px">
				<input type="submit" name="submit" value="Get User Logs" style="width:150px">
				<input type="submit" name="submit_filter" value="Clear Filters" style="width:150px">
			</td>
		</tr>
	</table>
	</form>
	<br/><br/>
<?php
	if (count($_REQUEST) > 0)
	{
		build_log_table();
	}
?>
</center>
</body>
</html>
