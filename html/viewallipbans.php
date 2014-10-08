<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_modsession';
			require '.config_commonfunctions';
			global $configfile;
			$usertofind = $_POST['name'];
		?>
		<table align="center" border="1" cellpadding="5">
				<table border="1" align="center" cellpadding="3">
					<tr>
		                                <td align="center" colspan="3"><a href="portal_banningsmanagement.php">Banning Management Menu</a></td>
                       				<td align="center" colspan="2"><a href="logout.php">Logout</a></td>
						<td colspan="4"></td>
		                        </tr>
					<tr>
						<td></td>
						<td></td>
						<td>Username</td>
						<td>IP Address</td>
						<td>Moderator</td>
						<td>Created On</td>
						<td>Duration</td>
						<td>Reason</td>
						<td>Displayed Reason</td>
					</tr>
					<?php
						$dbserv = get_config_value($configfile,"dbserver");
						if (strpos(strtolower($dbserv),"fail") !== false){ $results = strtolower($dbserv); return $results; exit; }
						$dbuser = get_config_value($configfile,"dbusername");
						if (strpos(strtolower($dbuser),"fail") !== false){ $results = strtolower($dbuser); return $results; exit; }
						$dbpass = get_config_value($configfile,"dbpassword");
						if (strpos(strtolower($dbpass),"fail") !== false){ $results = strtolower($dbpass); return $results; exit; }
						$dbname = get_config_value($configfile,"dbname");
						if (strpos(strtolower($dbname),"fail") !== false){ $results = strtolower($dbname); return $results; exit; }
						$dbtable = get_config_value($configfile,"dbbantable");
						if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
						$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
						if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
						$query = mysql_query("SELECT * FROM " . $dbtable . " WHERE ip_address = '" . mysql_real_escape_string($usertofind) . "' ORDER BY time_from DESC");
						if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
						$i= 0;
						while ($row = mysql_fetch_array($query)){
							$i = $i + 1;
							$moderatorname = locate_username_byid($row['id_admin']);
							echo '<tr>';
							echo '<form action="deleteban.php" method="post">';
                                                        echo '<td align="center"><input type="submit" value="Delete" /></td>';
                                                        echo '<input type="hidden" name="username" value="' . $row['user_name'] . '">';
                                                        echo '<input type="hidden" name="starttime" value="' .  $row['time_from'] . '">';
                                                        echo '</form>';
							echo '<form action="updateaban.php" method="post">';
							echo '<td align="center"><input type="submit" value="Update" /></td>';
							echo '<td><input type="text" name="username" value="' . $row['user_name'] . '" size="35" readonly></td>';
							echo '<td><input type="text" name="ipaddress" value="' . $row['ip_address'] . '" size="13" readonly></td>';
							echo '<td><input type="text" name="moderator" value="' . $moderatorname . '" size="15" readonly></td>';
							echo '<td><input type="text" name="starttime" value="' . $row['time_from'] . '" size="20" readonly></td>';
							echo '<td><input type="text" name="minutes" value="' . $row['minutes'] . '" size="4" readonly></td>';
							echo '<td><input type="text" name="reason" value="' . $row['reason'] . '" size="255" readonly></td>';
							echo '<td><input type="text" name="visiblereason" value="' . $row['visible_reason'] . '" size="255" readonly></td>';
							echo '</form>';
							echo '</tr>';
						}	
						mysql_close($dbconnection);
						echo '<tr><td colspan="9" align="left">' . $i . ' Total Bans</td></tr>';
					?>
				</table>
		</table>
	</body>
</html>
