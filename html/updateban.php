<!DOCTYPE html>
<html>
<head>
<title>Servatrice Administrator</title>
</head>
	<body>
		<?php
			require '.auth_modsession';
            		require '.config_commonfunctions';
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="viewallbans.php">View All Bannings</a></td>
				<td align="center"><a href="portal_banningsmanagement.php">Bannings Management Menu</a></td>
                                <td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="3" align="center">
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							if (empty($_POST['reason'])){ echo "failed, reason can not be blank"; exit; }
							if (empty($_POST['visiblereason'])){ echo "failed, visible reason can not be blank"; exit; }
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

			                                $minutes_to_components = calculate_string($_POST['minutes']); // Calculate as math string

                        			        $query = mysql_query("UPDATE " . trim($dbtable) . " SET minutes='" . $minutes_to_components . "',ip_address='" . trim($_POST['ipaddress']) . "',user_name='" . trim(mysql_real_escape_string($_POST['username'])) . "',reason='" . trim(mysql_real_escape_string($_POST['reason'])) . "',visible_reason='" . trim(mysql_real_escape_string($_POST['visiblereason'])) . "' WHERE user_name='" . trim(mysql_real_escape_string($_POST['username'])) . "' AND time_from='" . trim($_POST['starttime']) . "'");
							if (!query){ $results = "failed, " . mysql_error(); }
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							mysql_close($dbconnection);
							echo "Ban updated successfully.";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
