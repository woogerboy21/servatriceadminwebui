<!DOCTYPE html>
<html>
<head>
<title>Servatrice Administrator</title>
</head>
	<body>
		<?php
			require '.config_commonfunctions';
        	        global $configfile;
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="loginpage.php">Account Log-in</a></td>
                                <td align="center"><a href="index.php">Home</a></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							$usernametoregister = $_POST["nametoregister"];
							$passwordtoregister = $_POST["passwordtouse"];
							$emailtoregister = $_POST["emailtouse"];
							if (empty($usernametoregister)){ echo "invalid username, please retry"; exit; }
							if (empty($passwordtoregister)){ echo "invalid password, please retry"; exit; }
							if (empty($emailtoregister)){ echo "invalid email, please retry"; exit; }
							$creationresults = add_user($usernametoregister,$passwordtoregister,$emailtoregister);
							echo $creationresults;
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
