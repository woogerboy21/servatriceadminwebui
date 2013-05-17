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
				<td align="center"><a href="portal_banningsmanagement.php">Banning Management Menu</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<form action="deletecomplaint.php" method="post">
				<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						if (empty($_POST['messageid'])){ echo '<tr><td align="center" colspan="2">Invalid message id.</td></tr>'; exit; }
						$results = delete_complaint($_POST['messageid']);
						if (strpos(strtolower($results),"fail") !== false){ echo '<tr><td align="center" colspan="2">' . $results . '</td></tr>'; exit; }
						echo '<tr><td align="center" colspan="2">Successfully deleted complaint ' . $_POST['messageid'] . '.</td></tr>';
					}
				?>
			</form>
		</table>
	</body>
</html>
