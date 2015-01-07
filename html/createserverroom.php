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
							$autojoin = $_POST['autojoinvalue'];
							$roomname = $_POST['roomname'];
							if (empty($roomname)){ echo "failed, room name can not be blank"; exit; }
							$roomdescr = $_POST['roomdescription'];
                                                        if (empty($roomdescr)){ echo "failed, room description can not be blank"; exit; }
							$roommessage = $_POST['welcomemessage'];
                                                        if (empty($roommessage)){ echo "failed, room message can not be blank"; exit; }
							$results = add_room($idserver,$roomname,$roomdescr,$autojoin,$roommessage);
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "Server room created successfully";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
