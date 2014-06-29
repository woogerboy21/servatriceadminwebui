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
		<form action="deleteban.php" method="post">
			<table align="center" border="1" cellpadding="5">
				<tr>
					<td align="center"><a href="portal_banningsmanagement.php">Banning Management Menu</a></td>
					<td align="center"><a href="logout.php">Logout</a></td>
				</tr>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="username" size="35" maxlength="35" value="" /></td>
				</tr>
				<tr>
					<td>Created On:</td>
					<td><input type="text" name="starttime" size="35" maxlength="35" value="" /></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" value="Delete Ban" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
