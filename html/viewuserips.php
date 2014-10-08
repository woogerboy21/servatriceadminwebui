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
			<tr>
				<td align="center"><a href="portal_sessionsmanagement.php">Session Management Menu</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1" align="center" cellpadding="3">
						<tr>
							<td>IP Address</td>
						</tr>
						<?php
							$dbserv = get_config_value($configfile,"dbserver");
							$dbuser = get_config_value($configfile,"dbusername");
							$dbpass = get_config_value($configfile,"dbpassword");
							$dbname = get_config_value($configfile,"dbname");
							$dbtable = get_config_value($configfile,"dbsessiontable");
							$dbusertable = get_config_value($configfile,"dbusertable");
							if (empty($usertofind)){ echo '<tr><td align="center" colspan="4">Failed to determin user name to locate</td></tr>'; exit; }
							if (strpos(strtolower($dbserv),"fail") !== false){ $results = strtolower($dbserv); return $results; exit; }
							if (strpos(strtolower($dbuser),"fail") !== false){ $results = strtolower($dbuser); return $results; exit; }
							if (strpos(strtolower($dbpass),"fail") !== false){ $results = strtolower($dbpass); return $results; exit; }
							if (strpos(strtolower($dbname),"fail") !== false){ $results = strtolower($dbname); return $results; exit; }
							if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
							if (strpos(strtolower($dbusertable),"fail") !== false){ $results = strtolower($dbusertable); return $results; exit; }
							$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
							if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
							$query = mysql_query("SELECT DISTINCT(ip_address) FROM " . $dbtable . " WHERE user_name='" . $usertofind . "'");
                	               			if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
							while ($row = mysql_fetch_array($query)){
								echo '<tr>';
								echo '<td>' . $row['ip_address'] . '</td>';
								echo '</tr>';
							}
							echo '<tr><td colspan="5" align="right">(' . $usertofind . ') User IPs</td></tr>';	
							mysql_close($dbconnection);
						?>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
