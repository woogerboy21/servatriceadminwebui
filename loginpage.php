<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.config_commonfunctions';
			global $configfile;
			session_start();
        		session_unset();
        		session_destroy();
		?>
		<form action="authentication.php" method="post">
			<table align="center" border="1" cellpadding="5">
				<tr><td colspan="2" align="center"><a href="index.php">Home</a></td></tr>
				<tr><td>Username:</td><td><input type="text" name="inputeduname" maxlength="35" value="" size="35"/></td></tr>
				<tr><td>Password:</td><td><input type="password" name="inputedpword" maxlength="120" value="" size="35"/></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" value="Log-in" /></td></tr>
			</table>
		</form>
	</body>
</html>
