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
							$ipaddress = $_POST['ipaddress'];
							if (empty($ipaddress)){ echo "failed, ipaddress can not be blank"; exit; }
							$results = add_ipban($ipaddress);
							if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							echo "<center>Firewall rule scheduled to be added.<br>Rule should take place shortly.</center>";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
