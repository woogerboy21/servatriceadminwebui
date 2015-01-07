<!DOCTYPE html>
<html>
<head>
<title>Servatrice Administrator</title>
</head>
	<body>
		<?php
                        require '.auth_adminsession';
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
							$idserver = $_POST['idserver'];
							if (empty($idserver)){ echo "failed, server id can not be blank"; exit; }
							$game = $_POST['gamename'];
							if (empty($game)){ echo "failed, game name can not be blank"; exit; }
							
							$results = add_game_type($idserver,$game);
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "Game type created successfully";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
