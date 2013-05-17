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
		<form action="createban.php" method="post">
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
					<td>IP Address:</td>
					<td><input type="text" name="ipaddress" size="35" maxlength="35" value="" /></td>
				</tr>
				<tr>
					<td>Moderator Name:</td>
 					<td><input type="text" name="modname" size="35" maxlength="255" value="<?php echo $_SESSION['username']; ?>" disabled /></td>
				</tr>
				<tr>
					<td>Start Time:</td>
					<td><input type="text" name="start" size="35" maxlength="255" value="<?php echo date("Y-m-d H:i:s"); ?>" /></td>
				</tr>
				<tr>
					<td>Duration (Min)</td>
					<td><input type="text" name="duration" size="35" maxlength="35" value="" /></td>
				</tr>
				<tr>
					<td>Reason:</td>
					<td><input type="text" name="reason" size="35" maxlength="120" value="" /></td>
				</tr>
				<tr>
					<td>Diplayed Reason:</td>
					<td><input type="text" name="displayreason" size="35" maxlength="255" value="" /></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" value="Create Ban" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
