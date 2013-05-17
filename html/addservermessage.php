<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_modsession';
			require '.config_commonfunctions';
			global $configfile;
			$id = get_config_value($configfile,"serverid");
			if (strpos(strtolower($id),"fail") !== false){ $results = strtolower($id); return $results; exit; }
		?>
		<form action="createservermessage.php" method="post">
			<table align="center" border="1" cellpadding="5">
				<tr>
					<td align="center"><a href="portal_servermanagement.php">Server Management Menu</a></td>
					<td align="center"><a href="logout.php">Logout</a></td>
				</tr>
				<tr>
					<td>Server ID:</td>
					<td><input type="text" name="idserver" size="68" maxlength="35" value="<?php if (!empty($id)){ echo $id; } ?>" /></td>
				</tr>
				<tr>
					<td>Time Stamp:</td>
					<td><input type="text" name="timest" size="68" maxlength="35" value="<?php echo date("Y-m-d H:i:s"); ?>" /></td>
				</tr>
				<tr>
					<td>Message (HTML Format):</td>
 					<td><textarea name="message" rows="15" cols="50" value="" /></textarea></td>
				</tr>
				<tr>
                                        <td align="center" colspan="2"><input type="submit" value="Add Message" /></td>
                                </tr>
			</table>
		</form>
	</body>
</html>
