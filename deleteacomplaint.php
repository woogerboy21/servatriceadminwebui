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
				<td align="center"><a href="portal_complaintmanagement.php">Complaint Management Menu</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<form action="deletecomplaint.php" method="post">
				<tr><td>Complaint ID</td><td><input type="text" size="35" name="messageid"></td></tr>
				<tr><td align="center" colspan="2"><input type="submit" value="Delete Complaint" /></td></tr>
			</form>
		</table>
	</body>
</html>
