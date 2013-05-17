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
			$iptofind = $_POST['ipaddress'];
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="portal_sessionsmanagement.php">Session Management Menu</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" align="center" cellpadding="3">
						<tr>
							<td>Username</td>
							<td>IP Address</td>
							<td>Reg User</td>
							<td>Login Time</td>
                                                        <td>Logout Time</td>
						</tr>
						<?php
							$dbserv = get_config_value($configfile,"dbserver");
							$dbuser = get_config_value($configfile,"dbusername");
							$dbpass = get_config_value($configfile,"dbpassword");
							$dbname = get_config_value($configfile,"dbname");
							$dbtable = get_config_value($configfile,"dbsessiontable");
							$dbusertable = get_config_value($configfile,"dbusertable");
							if (empty($iptofind)){ echo '<tr><td align="center" colspan="4">Failed to determin ip address to locate</td></tr>'; exit; }
							if (strpos(strtolower($dbserv),"fail") !== false){ $results = strtolower($dbserv); return $results; exit; }
							if (strpos(strtolower($dbuser),"fail") !== false){ $results = strtolower($dbuser); return $results; exit; }
							if (strpos(strtolower($dbpass),"fail") !== false){ $results = strtolower($dbpass); return $results; exit; }
							if (strpos(strtolower($dbname),"fail") !== false){ $results = strtolower($dbname); return $results; exit; }
							if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
							if (strpos(strtolower($dbusertable),"fail") !== false){ $results = strtolower($dbusertable); return $results; exit; }
							$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
							if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
							$query = mysql_query("SELECT * FROM " . $dbtable . " WHERE ip_address='" . $iptofind . "'");
                	               			if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
							while ($row = mysql_fetch_array($query)){
								$regquery = mysql_query("SELECT name FROM " . $dbusertable . " WHERE name='" . $row['user_name'] . "'");
								if (!regquery){ $results = "failed, " . mysql_error(); return results; exit; }
								$regrow = mysql_fetch_array($regquery);
								echo '<tr>';
								echo '<td>' . $row['user_name'] . '</td>';
								echo '<td>' . $row['ip_address'] . '</td>';
								if (strtolower($regrow['name']) == strtolower($row['user_name'])){ echo "<td>YES</td>"; } else { echo "<td>NO</td>"; }
								echo '<td>' . $row['start_time'] . '</td>';
                                                                if ($row['end_time'] == 'NULL'){ echo '<td></td>'; } else { echo '<td>' . $row['end_time'] . '</td>'; }
                                                                echo '</tr>';
							}
							mysql_close($dbconnection);
						?>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
