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
			$banner = get_config_value($configfile,"portal_complaintmanagementmessage");
			if (strpos(strtolower($banner),"fail") !== false){ echo $banner; exit; }
			$playercount = get_playercount();
			$modcount = get_modcount();
			$enablecomplaintreporting = get_config_value($configfile,"enablecomplaintreporting");
		?>
		<table align="center" border="1" cellpadding="5">
			<?php require 'urgentmessage.php' ?>
			<tr><td>Complaint Management Menu</td><td align="right">(<?php echo $playercount; ?> Active Players)</td><td align="center"><a href="availableadmins.php" onclick="window.open('availableadmins.php','popup','width=200,height=200,scrollbars=yes,resizable=yes,toolbar=no,directories=no,location=no,menubar=no,status=no,left=50,top=0'); return false">(<?php echo $modcount; ?> Active Moderators)</td></tr>
			<tr>
				<td><a href="admin_portal.php">Administration Menu</a></td>
				<?php 
					echo '<td rowspan="9" colspan="2" align="center">';
                                        if(!empty($banner)){ echo $banner; }
                                        echo '</td>';
				?>
			</tr>
			<tr><td><a href="abusedetails.php">Report Abuse</a></td><tr>
			<?php
				if ($enablecomplaintreporting == "yes") {
					echo '<tr><td><a href="viewallcomplaints.php">View Complaints</a></td></tr>';
					echo '<tr><td><a href="viewclaimedcomplaints.php">Update Claimed Complaint</a></td></tr>';
					echo '<tr><td><a href="chooseclaimedcomplainttoclose.php">Close Claimed Complaint</a></td></tr>';
					echo '<tr><td><a href="viewallclosedcomplaints.php">View Closed Complaints</a></td></tr>';
					if ($_SESSION['admin'] == 1){ echo '<tr><td><a href="deleteacomplaint.php">Delete a Complaint</a></td></tr>'; }
				}
			?>
			<tr><td><a href="logout.php">Logout</a></td></tr>
			<?php include 'admin_footer.php'; ?>
		</table>
	</body>
</html>
