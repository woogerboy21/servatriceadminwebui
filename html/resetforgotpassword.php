<!DOCTYPE html>
<html>
<head>
<title>Cockatrice Forgot Password Reset</title>
</head>
	<body>
		<?php
			require '.config_commonfunctions';
        	        global $configfile;
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
                                <td align="center"><a href="index.php">Home</a></td>
			</tr>
			<tr>
				<td>
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							$emailaddress = $_POST["emailaddress"];
							if (empty($emailaddress)){ echo "invalid email, please retry"; exit; }
							$creationresults = generate_forgotpasswordfile($emailaddress);
							if ($creationresults == 'success'){
								echo '<center>Account password recovery email has been generated and will be mailed out shortly.<br>Please follow the instructions listed in the email to reset your password.<br>The account recovery information sent in the email will only be valid till midnight EST time.</center>';
							} else {
								echo '<center>Failed to generate password recovery information, please contact us to reset your password.';
							}
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
