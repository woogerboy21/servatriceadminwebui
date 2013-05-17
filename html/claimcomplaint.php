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
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="viewallcomplaints.php">View Complaints</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
					if (strtolower($_SESSION['username']) == strtolower($_POST['about'])){ echo '<tr><td align="center" colspan="2">Complaints can not be claimed by same user complaint is about.</td></tr>'; exit; }
	                                if (empty($_POST['messageid'])){ echo '<tr><td align="center" colspan="2">Please select a complaint to view.</td></tr>'; exit; }
					if (empty($_SESSION['username'])){ echo '<tr><td align="center" colspan="2">Failed to determine moderator name.</td></tr>'; exit; }
					$results = claim_complaint($_SESSION['username'],$_POST['messageid']);
					if (strpos(strtolower($results),"fail") !== false){ echo '<tr><td align="center" colspan="2"><Failed to claim complaint report. Please try again./td></tr>'; exit; }
					echo '<tr><td align="center" colspan="2">Succesfully claimed report ' . trim($_POST['messageid']) . '.';
				}
                        ?>
		</table>
	</body>
</html>
