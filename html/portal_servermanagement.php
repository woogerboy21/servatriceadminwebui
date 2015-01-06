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
			$banner = get_config_value($configfile,"portal_servermanagementmessage");
			$flafile = get_config_value($configfile,"failedloginattemptlogfilename");
                        if (strpos(strtolower($banner),"fail") !== false){ echo $banner; exit; }
                        $playercount = get_playercount();
			$modcount = get_modcount();
		?>
		<table align="center" border="1" cellpadding="5">
			<?php require 'urgentmessage.php' ?>
			<tr><td>Server Management Menu</td><td align="right">(<?php echo $playercount; ?> Active Players)</td><td align="center"><a href="availableadmins.php" onclick="window.open('availableadmins.php','popup','width=200,height=200,scrollbars=yes,resizable=yes,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false">(<?php echo $modcount; ?> Active Moderators)</a></td></tr>
			<tr>
				<td><a href="admin_portal.php">Administration Menu</a></td>
				<td rowspan="10" colspan="2" align="center"><?php if(!empty($banner)){ echo $banner; } ?></td>
			</tr>
			<tr><td><a href="viewservermessages.php">View Server Message</a></td></tr>
			<tr><td><a href="addservermessage.php">Add Server Message</a></td></tr>
			<tr><td><a href="deleteservermessage.php">Delete Server Message</a></td></tr>
			<tr><td><a href="deletereplays.php">Delete Replays</a></td></tr>
			<tr><td><a href="deleteuptimedata.php">Delete Uptime Data</a></td></tr>
			<tr><td><a href="changelog.html">View Servatrice Administrator Changelog</a></td></tr>
			<tr><td><a href="viewfla.php">View Failed Log-In Attempts</a></td></tr>
			<tr><td><a href="viewlog.php">View Chat Logs</a></td></tr>
			<tr><td><a href="logout.php">Logout</a></td></tr>
			<?php include 'admin_footer.php'; ?>
		</table>
	</body>
</html>
