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
		?>
		<form action="removeserverroom.php" method="post">
			<table border="1" align="center" cellpadding="3">
				<tr>
		                        <td align="center" colspan="0"><a href="portal_servermanagement.php">Server Management Menu</a></td>
                       			<td align="center" colspan="0"><a href="logout.php">Logout</a></td>
		                </tr>
				<tr>
					<td align="center" colspan="2">
						Room:
						<select name="roomid">
							<?php
								$dbserv = get_config_value($configfile,"dbserver");
								$dbuser = get_config_value($configfile,"dbusername");
								$dbpass = get_config_value($configfile,"dbpassword");
								$dbname = get_config_value($configfile,"dbname");
								$dbtable = get_config_value($configfile,"dbroomtable");
								$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
								if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
								$query = mysql_query("SELECT * FROM " . $dbtable . " ORDER BY id");
								if (!query){ echo "failed: " . mysql_error(); exit; }
								while ($row = mysql_fetch_array($query)){
									echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
								}	
								mysql_close($dbconnection);
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" value="Delete" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
