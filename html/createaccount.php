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
						if ($_SERVER['REQUEST_METHOD'] == 'POST')
						{
							$username_to_reg = $_POST["nametoregister"];
							$pass_to_reg = $_POST["passwordtouse"];
							$email_to_reg = $_POST["emailtouse"];

							$username_has_valid_chars = preg_match('/^[\w-]+$/', $username_to_reg);
							$username_has_bad_name = preg_match('/^Player_\d+$/', $username_to_reg);

							if (empty($username_to_reg) || empty($pass_to_reg) || empty($email_to_reg))
							{
								echo "All fields are required";
							}
							else if ($username_has_valid_chars && $username_has_bad_name === 0) // Only A-Z, a-z, 0-9, -, _ AND does not start with "Player_"
							{
								echo add_user($username_to_reg, $pass_to_reg, $email_to_reg);
							}
							else
							{
								echo "You may only use <b>A-Z, a-z, 0-9, _,</b> and <b>-</b> in your username. In addition, your username can't start with \"Player_\"<br/>\n".
									"Username Is Valid: $username_has_valid_chars<br/>\nUsername Starts With 'Player_': $username_has_bad_name";
							}
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>