<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_modsession';
			require '.config_commonfunctions';
		?>
		<form action="viewallusersbans.php" method="post">
			<table align="center" border="1" cellpadding="5">
				<tr>
					<td align="center"><a href="portal_banningsmanagement.php">Banning Management Menu</a></td>
					<td align="center"><a href="logout.php">Logout</a></td>
				</tr>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name" size="35" maxlength="35" value="" /></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" value="Locate" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
