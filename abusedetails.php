<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_usersession';
			require '.config_commonfunctions';
			global $configfile;
		?>
		<form action="reportabuse.php" method="post">
			<table align="center" border="1" cellpadding="5">
				<tr>
					<?php
						if ($_SESSION['admin'] > 0){
							echo '<td align="center"><a href="portal_complaintmanagement.php">Complaint Management Menu</a></td>';
						} else {
							echo '<td align="center"><a href="user_portal.php">Main Menu</a></td>';
						}
					?>
					<td align="center"><a href="logout.php">Logout</a></td>
				</tr>
				<tr>
					<td>From:</td>
					<td><input type="text" name="from" size="50" maxlength="35" value="<?php echo $_SESSION['username']; ?>" readonly /></td>
				</tr>
				<tr>
					<td>About: (single user)</td>
					<td><input type="text" name="about" size="50" maxlength="35" /></td>
				</tr>
				<tr>
					<td>Date/Time of Issue:</td>
                                        <td><input type="text" name="dtofissue" size="50" maxlength="50" /></td>
				</tr>
				<tr>
					<td>Game Number:</td>
					<td><input type="text" name="gamenumber" size="50" maxlength="35" /></td>
				</tr>
				<tr>
					<td>Summary:</td>
					<td><input type="text" name="summary" size="50" maxlength="50" /></td>
				</tr>
				<tr>
					<td>
						Description:<br>(Be as detailed as possible)<br>
						<a href="availableadmins.php" onclick="window.open('help_reportabuse.php','popup','width=600,height=500,scrollbars=yes,resizable=yes,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false">Help</a>
					</td>
					<td><textarea name="message" cols="57" rows="20" maxlength="1024" value="" /></textarea></td>
				</tr>
				<tr>
					<td>Screenshot URL</td>
					<td><input type="text" name="screenshoturl" size="50" maxlength="128" /></td>
				</tr>
				<tr><td align="center" colspan="2"><input type="submit" value="Report" /></td></tr>
			</table>
		</form>
	</body>
</html>
