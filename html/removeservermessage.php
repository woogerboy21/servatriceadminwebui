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
							$idserver = $_POST['idserver'];
							if (empty($idserver)){ echo "failed, server id can not be blank"; exit; }
							$timest = $_POST['timest'];
							if (empty($timest)){ echo "failed, time stamp can not be blank"; exit; }
							$results = delete_servermessage($idserver,$timest);
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "Message deleted successfully";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
