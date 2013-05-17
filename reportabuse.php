<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<table align="center" border="1" cellpadding="5">
                        <tr>
				<?php
					require '.auth_usersession';
                                        require '.config_commonfunctions';
					global $configfile;
					if ($_SESSION['admin'] > 0){
						echo '<td align="center"><a href="portal_complaintmanagement.php">Complaint Management Menu</a></td>';
					} else {
						echo '<td align="center"><a href="user_portal.php">Main Menu</a></td>';
					}
				?>
				<td align="center"><a href="logout.php">Logout</a></td>
                        </tr>
			<tr>
				<td colspan="2" align="center">
					<?php
						if (empty($_POST['about'])){ echo "failed, about user can not be blank"; exit; }
						if (empty($_POST['dtofissue'])){ echo "failed, date time of issue can not be blank"; exit; }
						if (empty($_POST['summary'])){ echo "failed, summary can not be blank"; exit; }
						if (empty($_POST['message'])){ echo "failed, message can not be blank"; exit; }
						$results = add_abusecomplaint($_SESSION['username'],$_POST['about'],$_POST['dtofissue'],$_POST['gamenumber'],$_POST['summary'],$_POST['message'],$_POST['screenshoturl']);
						if (strpos(strtolower($results),"fail") !== false){ $results = "Failed to file report, please try again."; } else { $results = "Report filed successfully, thank you."; }
						echo $results;
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
