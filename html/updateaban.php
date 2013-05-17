<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_adminsession';
			require '.config_commonfunctions';
			global $configfile;
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$dbserv = get_config_value($configfile,"dbserver");
				$dbuser = get_config_value($configfile,"dbusername");
				$dbpass = get_config_value($configfile,"dbpassword");
				$dbname = get_config_value($configfile,"dbname");
				$dbtable = get_config_value($configfile,"dbbantable");
				if (strpos(strtolower($dbserv),"fail") !== false){ $results = strtolower($dbserv); return $results; exit; }
				if (strpos(strtolower($dbuser),"fail") !== false){ $results = strtolower($dbuser); return $results; exit; }
				if (strpos(strtolower($dbpass),"fail") !== false){ $results = strtolower($dbpass); return $results; exit; }
				if (strpos(strtolower($dbname),"fail") !== false){ $results = strtolower($dbname); return $results; exit; }
				if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
				$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
				if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
                	        $query = mysql_query("SELECT * FROM " . trim($dbtable) . " WHERE user_name='" . $_POST['username'] . "' AND time_from='" . $_POST['starttime'] . "'" );
				if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
				while ($row = mysql_fetch_array($query)){
					$username = $row['user_name'];
					$ipaddress = $row['ip_address'];
					$starttime = $row['time_from'];
					$minutes = $row['minutes'];
					$reason = $row['reason'];
					$displayreason = $row['visible_reason'];
				}
				mysql_close($dbconnection);
			}
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="portal_banningsmanagement.php">Banning Management Page</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<form action="updateban.php" method="post">
				<tr><td>UserName:</td><td><input type="text" size="35" name="username" value="<?php echo $username; ?>" readonly /></input></td></tr>
				<tr><td>IP Address:</td><td><input type="text" size="35" name="ipaddress" value="<?php echo $ipaddress; ?>" readonly /></td></tr>
				<tr><td>Start Time:</td><td><input type="text" size="35" name="starttime" value="<?php echo $starttime; ?>" readonly /></td></tr>
				<tr><td>Minutes:</td><td><input type="text"size="35" name="minutes" value="<?php echo $minutes; ?>" /></td></tr>
				<tr><td>Reason:</td><td><input type="text" size="35" name="reason" value="<?php echo $reason; ?>" /></td></tr>
				<tr><td>Visible Reason:</td><td><input type="text" size="35" name="visiblereason" value="<?php echo $displayreason; ?>" /></td></tr>
				<tr><td align="center" colspan="2"><input type="submit" value="Update" /></td></tr>
			</form>
		</table>
	</body>
</html>
