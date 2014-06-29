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
				<td align="center"><a href="portal_banningsmanagement.php">Banning Management Menu</a></td>
                                <td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							$user = $_POST['username'];
							if (empty($user)){ echo "failed, user name can not be blank"; exit; }
							$timestamp = $_POST['starttime'];
							if (empty($timestamp)){ echo "failed, created on time stamp can not be blank"; exit; }
							$results = delete_ban($user,$timestamp);
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "Ban removed successfully";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
