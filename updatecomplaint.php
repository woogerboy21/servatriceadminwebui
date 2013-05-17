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
				<td align="center"><a href="viewclaimedcomplaints.php">View Claimed Complaints</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
					if (empty($_POST['messageid'])){ echo '<tr><td align="center" colspan="2">Failed, message id can not be blank.</td></tr>'; exit; }
					if (empty($_POST['modnotes'])){ echo '<tr><td align="center" colspan="2">Failed, notes can not be blank.</td></tr>'; exit; }
					$results = update_complaint_modnotes($_POST['modnotes'],$_POST['messageid']);
                        		if (strpos(strtolower($results),"fail") !== false){ echo '<tr><td align="center" colspan="2">' . $results . '</td></tr>'; exit; }
					echo '<tr><td align="center" colspan="2">Successfully updated complaint ' . $_POST['messageid'] . '.</td></tr>';
				}
			?>
		</table>
	</body>
</html>
