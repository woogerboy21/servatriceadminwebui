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
				<td align="center"><a href="portal_servermanagement.php">Server Management Menu</a></td>
                                <td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							$idroom = $_POST['roomid'];
							if (empty($idroom)){ echo "failed, server id can not be blank"; exit; }
							$results = delete_room(trim($idroom));
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "Room deleted successfully";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
