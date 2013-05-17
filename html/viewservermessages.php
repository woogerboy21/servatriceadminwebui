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
			<tr>
				<td align="center"><a href="portal_servermanagement.php">Server Management Menu</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<form action="purgebannings.php" method="post">
						<table border="1" align="center" cellpadding="3">
							<tr>
								<td>ID Server</td>
								<td>Time Stamp</td>
								<td>Message</td>
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
								$dbtable = get_config_value($configfile,"dbmessagetable");
								if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
								$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
								if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
								$query = mysql_query("SELECT * FROM " . $dbtable);
								if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
								$i= 0;
								while ($row = mysql_fetch_array($query)){
									$i = $i + 1;
									echo '<tr>';
									echo '<td>' . $row['id_server'] . '</td>';
									echo '<td>' . $row['timest'] . '</td>';
									echo '<td>' . $row['message'] . '</td>';
									echo '</tr>';
								}	
								mysql_close($dbconnection);
								echo '<tr><td colspan="6" align="right">' . $i . ' Total Messages</td></tr>';
							?>
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>
