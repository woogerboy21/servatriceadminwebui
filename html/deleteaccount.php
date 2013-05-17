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
		?>
		<table align="center" border="1" cellpadding="5">
                        <tr>
                                <td align="center"><a href="portal_manageaccounts.php">Account Management Menu</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
                        </tr>
			<tr>
				<td colspan="2">
					<?php
						$user = $_POST['name'];
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							$results = delete_user($_POST['username']);
							if (strpos(strtolower($results),"fail") != false){ echo $results; exit; }
							echo "User account deleted";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
