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
				<td align="center"><a href="portal_banningsmanagement.php">Bannings Management Menu</a></td>
                                <td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							$user = $_POST['username'];
							$ipaddress = $_POST['ipaddress'];
							$modname = $_POST['modname'];
							if (empty($modname)){ $modname = $_SESSION['username']; }
							$start = $_POST['starttime'];
							if (empty($start)) { $start = date("Y-m-d H:i:s"); }
							$duration = $_POST['duration'];
							$reason = $_POST['reason'];
							if (empty($reason)){ echo "failed, reason can not be blank"; exit; }
							$displayreason = $_POST['displayreason'];
							if (empty($displayreason)){ $displayreason = $reason; }
							$results = add_ban($user,$ipaddress,$modname,$start,$duration,$reason,$displayreason);
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "Ban created successfully";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
