<DOCTYPE=html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.auth_usersession';
			require '.config_commonfunctions';
			global $configfile;
			$banner = trim(get_config_value($configfile,'userportalwelcomemessage'));
			$playercount = get_playercount();
                        $modcount = get_modcount();
			if (strpos(strtolower($banner),"fail") !== false){ echo $banner; exit; }
			$enablecomplaintreporting = trim(get_config_value($configfile,'enablecomplaintreporting'));
		?>

		<table align="center" border="1" cellpadding="5">
			<?php require 'user_urgentmessage.php'; ?>
			<tr><td>Main Menu</td><td align="right">(<?php echo $playercount; ?> Active Players)</td><td align="right"><a href="availableadmins.php" onclick="window.open('availableadmins.php','popup','width=200,height=200,scrollbars=yes,resizable=yes,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false">(<?php echo $modcount; ?> Active Moderators)</a></td></tr>
			<tr>
				<td><a href="manageaccount.php">Manage Account</a></td>
				<?php
					if ($enablecomplaintreporting == "yes") { 
						echo '<td rowspan="5" colspan="2" align="center">';
						if (!empty($banner)){ echo $banner; }
						echo '</td>';
					} else {
						echo '<td rowspan="4" colspan="2" align="center">';
                                                if (!empty($banner)){ echo $banner; }
                                                echo '</td>';
					}
				?>
			</tr>
			<?php if ($enablecomplaintreporting == "yes") { echo '<tr><td><a href="abusedetails.php">Report Abuse</a></td></tr>'; } ?>
			<tr><td><a href="viewmoderators.php">View Moderators</a></td></tr>
			<tr><td><a href="statistics.php">Statistics</a></td></tr>
			<tr><td><a href="logout.php">Logout</a></td></tr>
			<tr><td colspan="3" align="right"><?php echo "(" . $_SESSION['username'] . ")"; ?></td></tr>
		</table>
	</body>
</html>
