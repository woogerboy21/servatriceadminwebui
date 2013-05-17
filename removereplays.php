<!DOCTYPE html>
<html>
<head>
<title>Servatrice Administrator</title>
</head>
	<body>
		<?php
			global $configfile;
			require '.auth_modsession';
                        require '.config_commonfunctions';
                        $dbtable = get_config_value($configfile,"dbreplaytable");
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="portal_servermanagement.php">Server Management Menu</a></td>
                                <td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							$count = $_POST['count'];
							if (empty($count)){ echo "failed, number of replays to delete can not be blank"; exit; }
							if (empty($dbtable)){ echo "failed, unable to locate replay table name"; exit; }
							$results = delete_dbrows($count,$dbtable);
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "Replays removed successfully";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
