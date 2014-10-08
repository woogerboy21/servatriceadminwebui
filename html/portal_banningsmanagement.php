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
			$banner = get_config_value($configfile,"portal_banningsmanagementmessage");
			if (strpos(strtolower($banner),"fail") !== false){ echo $banner; exit; }
			$playercount = get_playercount();
			$modcount = get_modcount();
			$enablecomplaintreporting = get_config_value($configfile,"enablecomplaintreporting");
		?>
		<table align="center" border="1" cellpadding="5">
			<?php require 'urgentmessage.php' ?>
			<tr><td>Banning Management Menu</td><td align="right">(<?php echo $playercount; ?> Active Players)</td><td align="center"><a href="availableadmins.php" onclick="window.open('availableadmins.php','popup','width=200,height=200,scrollbars=yes,resizable=yes,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false">(<?php echo $modcount; ?> Active Moderators)</td></tr>
			<tr>
				<td><a href="admin_portal.php">Administration Menu</a></td>
				<?php 
					if ($_SESSION['admin'] != 1){ 
						echo '<td rowspan="8" colspan="2" align="center">';
                                                if(!empty($banner)){ echo $banner; }
                                                echo '</td>';
					}
					if ($_SESSION['admin'] == 1){
						echo '<td rowspan="7" colspan="2" align="center">';
                                                if(!empty($banner)){ echo $banner; }
                                                echo '</td>';
					}
				?>
			</tr>
			<tr><td><a href="viewallbans.php">View all Bans</a></td></tr>
			<tr><td><a href="addban.php">Create a Ban</a></td></tr>
			<tr><td><a href="bandelete.php">Delete a Ban</a></td></tr>
			<?php /* if ($_SESSION['admin'] == 1){ echo '<tr><td><a href="locatebantoupdate.php">Update a Ban</a></td></tr>'; } */ ?> 
			<!-- <tr><td><a href="locatebantoupdate.php">Update a Ban</a></td></tr> -->
			<tr><td><a href="locateusersbans.php">Locate User Bans</a></td></tr>
			<tr><td><a href="locateipbans.php">Locate IP Bans</a></td></tr>
			<tr><td><a href="logout.php">Logout</a></td></tr>
			<?php include 'admin_footer.php'; ?>
		</table>
	</body>
</html>
