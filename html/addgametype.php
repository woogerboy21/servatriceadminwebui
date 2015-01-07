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
			$id = get_config_value($configfile,"serverid");
			if (strpos(strtolower($id),"fail") !== false){ $results = strtolower($id); return $results; exit; }
		?>
		<form action="creategametype.php" method="post">
			<table align="center" border="1" cellpadding="5">
				<tr>
					<td align="center"><a href="portal_servermanagement.php">Server Management Menu</a></td>
					<td align="center"><a href="logout.php">Logout</a></td>
				</tr>
				<tr>
					<td>Room ID:</td>
					<td>
						 <select name="idserver">
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
					<td>Game Name:</td>
					<td><input type="text" name="gamename" size="68" maxlength="35" value="" /></td>
				</tr>
				<tr>
                                        <td align="center" colspan="2"><input type="submit" value="Add Game" /></td>
                                </tr>
			</table>
		</form>
	</body>
</html>
