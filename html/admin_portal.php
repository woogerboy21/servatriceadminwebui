<DOCTYPE=html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_modsession';
			require '.config_commonfunctions';
			global $configfile;
			$banner = trim(get_config_value($configfile,'adminportalwelcomemessage')); 
			if (strpos(strtolower($banner),"fail") !== false){ echo $banner; exit; }
			$playercount = get_playercount();
			$modcount = get_modcount();
		?>

		<table align="center" border="1" cellpadding="5">
			<?php require 'urgentmessage.php' ?>
			<tr><td align="center">Administration Menu</td><td align="center">(<?php echo $playercount; ?> Active Players)</td><td align="center"><a href="availableadmins.php" onclick="window.open('availableadmins.php','popup','width=200,height=200,scrollbars=yes,resizable=yes,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false">(<?php echo $modcount; ?> Active Moderators)</a></td></tr>
			<tr>
				<?php
					echo '<td><a href="portal_manageaccounts.php">Account Management</a></td>';
                                        echo '<td rowspan="7" colspan="2" align="center">';
                                        if (!empty($banner)){ echo $banner; }
                                        echo '</td>';
				?>
			</tr>
			<tr><td><a href="portal_sessionsmanagement.php">Session Management</a></td></tr>
			<tr><td><a href="portal_complaintmanagement.php">Complaint Management</a></td></tr>
			<tr><td><a href="portal_banningsmanagement.php">Bannings Management</a></td></tr>
			<tr><td><a href="portal_servermanagement.php">Server Management</a></td></tr>
			<tr><td><a href="statistics.php">Statistics</a></td></tr>
			<tr><td><a href="logout.php">Logout</a></td></tr>
			<?php include 'admin_footer.php'; ?>
		</table>
	</body>
</html>
