<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_usersession';
			require '.config_commonfunctions';
			global $configfile;
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<?php
					if ($_SESSION['admin'] > 0){
						echo '<td align="center" colspan="3"><a href="portal_manageaccounts.php">Account Management Menu</a></td>';
					} else {
						echo '<td align="center" colspan="3"><a href="user_portal.php">Main Menu</a></td>';
					}
				?>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
			<tr>
				<td>Username</td>
				<td>Privilege Level</td>
				<td>Registration Date</td>
				<td>County</td>
			</tr>
			<tr>
				<?php
					$dbserv = get_config_value($configfile,"dbserver");
					$dbuser = get_config_value($configfile,"dbusername");
					$dbpass = get_config_value($configfile,"dbpassword");
					$dbname = get_config_value($configfile,"dbname");
					$dbtable = get_config_value($configfile,"dbusertable");
					if (strpos(strtolower($dbserv),"fail") !== false){ $results = strtolower($dbserv); return $results; exit; }
					if (strpos(strtolower($dbuser),"fail") !== false){ $results = strtolower($dbuser); return $results; exit; }
					if (strpos(strtolower($dbpass),"fail") !== false){ $results = strtolower($dbpass); return $results; exit; }
					if (strpos(strtolower($dbname),"fail") !== false){ $results = strtolower($dbname); return $results; exit; }
					if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
					$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
					if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
					$query = mysql_query("SELECT * FROM " . $dbtable . " WHERE admin != 0");
					if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
					$i= 0;
					while ($row = mysql_fetch_array($query)){
						$i = $i + 1;
						echo '<tr>';
						echo '<td>' . $row['name'] . '</td>';
						if ($row['admin'] == 1){ echo '<td>Administrator</td>'; }
						if ($row['admin'] == 2){ echo '<td>Moderator</td>'; }
						echo '<td>' . $row['registrationDate'] . '</td>';
						echo '<td>' . $row['country'] . '</td>';
						echo '</tr>';
					}	
					mysql_close($dbconnection);
					echo '<tr><td colspan="4" align="right">' . $i . ' Total Admin/Moderators</td></tr>';
				?>
			</tr>
		</table>
	</body>
</html>
