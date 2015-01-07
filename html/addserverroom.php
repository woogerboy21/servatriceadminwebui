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
			$id = get_config_value($configfile,"serverid");
			if (strpos(strtolower($id),"fail") !== false){ $results = strtolower($id); return $results; exit; }
		?>
		<form action="createserverroom.php" method="post">
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
					<td>Auto Join:</td>
					<td>
						<select name="autojoinvalue">
 							<option value=1>Yes</option>
							<option value=0>No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Room Name:</td>
					<td><input type="text" name="roomname" size="68" maxlength="35" value="" /></td>
				</tr>
				<tr>
					<td>Room Description:</td>
 					<td><textarea name="roomdescription" rows="15" cols="50" value="" /></textarea></td>
				</tr>
				<tr>
                                        <td>Welcome Message:</td>
                                        <td><textarea name="welcomemessage" rows="15" cols="50" value="" /></textarea></td>
                                </tr>
				<tr>
                                        <td align="center" colspan="2"><input type="submit" value="Add Room" /></td>
                                </tr>
			</table>
		</form>
	</body>
</html>
