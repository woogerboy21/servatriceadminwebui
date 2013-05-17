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
		?>
		<table align="center" border="1" cellpadding="5">
			<form action="purgebannings.php" method="post">
				<table border="1" align="center" cellpadding="3">
					<tr>
		                                <td align="center" colspan="6"><a href="portal_banningsmanagement.php">Banning Management Menu</a></td>
                       				<td align="center"><a href="logout.php">Logout</a></td>
		                        </tr>
					<tr>
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
						$query = mysql_query("SELECT * FROM " . $dbtable . " ORDER BY time_from DESC");
						if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
						$i= 0;
						while ($row = mysql_fetch_array($query)){
							$i = $i + 1;
							$moderatorname = locate_username_byid($row['id_admin']);
							echo '<tr>';
							echo '<td>' . $row['user_name'] . '</td>';
							echo '<td>' . $row['ip_address'] . '</td>';
							echo '<td>' . $moderatorname . '</td>';
							echo '<td>' . $row['time_from'] . '</td>';
							echo '<td>' . $row['minutes'] . '</td>';
							echo '<td>' . $row['reason'] . '</td>';
							echo '<td>' . $row['visible_reason'] . '</td>';
							echo '</tr>';
						}	
						mysql_close($dbconnection);
						echo '<tr><td colspan="7" align="right">' . $i . ' Total Bans</td></tr>';
					?>
				</table>
			</form>
		</table>
	</body>
</html>
