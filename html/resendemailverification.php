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
                                                echo '<td align="center"><a href="portal_manageaccounts.php">Account Management Menu</a></td>';
                                        } else {
                                                echo '<td align="center"><a href="manageaccount.php">Manage Account</a></td>';
                                        }
                                ?>
                                <td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr>

				<td colspan="2" align="center">
                                        <?php
                                                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							if (!empty($_POST['name'])){
								generate_accountverificationfile($_POST['name']);
                                                        	echo '<center>Email Verification Resent</center>';
							}
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>

