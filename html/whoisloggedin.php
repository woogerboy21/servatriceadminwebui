<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.config_commonfunctions';
			global $configfile;
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td colspan="2">
					<form action="purgestaleconnections.php" method="post">
						<table border="1" align="center" cellpadding="3">
							<?php
                                				session_start();
				                                if (is_null($_SESSION['admin'])){ echo '<tr><td align="center" colspan="5"><a href="index.php">Home</a></td></tr>'; }
                                				if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){ echo '<tr><td align="center" colspan="5"><a href="user_portal.php">Main Menu</a></td></tr>'; }
				                                if ($_SESSION['admin'] > 0){ echo '<tr><td align="center" colspan="5"><a href="admin_portal.php">Administration Menu</a></td></tr>'; }
				                        ?>
							<tr>
								<td>Username</td>
								<td>Login Time</td>
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
								$dbtable = get_config_value($configfile,"dbsessiontable");
								if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
								$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
								if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
								$query = mysql_query("SELECT * FROM " . $dbtable . " WHERE end_time IS NULL");
                	                			if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
								$usercount = 0;
								while ($row = mysql_fetch_array($query)){
									$usercount = $usercount + 1;
									echo '<tr>';
									echo '<td>' . $row['user_name'] . '</td>';
									echo '<td>' . $row['start_time'] . '</td>';
									echo '</tr>';
								}
								echo '<tr><td colspan="3" align="right">' . $usercount . ' Total Users</td></tr>';	
								mysql_close($dbconnection);
							?>
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>
