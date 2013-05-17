<!DOCTYPE html>
<header>
<title>Servatrice Administrator</title>
</header>
<body>
	<?php
		require '.auth_usersession';
		require '.config_commonfunctions';
		global $configfile;
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$current_username = $_POST['username'];
		} else {
			$current_username = $_SESSION['username'];
		}
		$current_privlevel = get_user_data($current_username,'admin');
		$current_realname = get_user_data($current_username,'realname');
		$current_gender = get_user_data($current_username,'gender');
		$current_email = get_user_data($current_username,'email');
		$current_country = get_user_data($current_username,'country');

	?>
	<form action="updateaccount.php" method="post">
		<table align="center" border="1" cellpadding="5">
			<tr>
				<?php
					if ($_SESSION['admin'] > 0){
						echo '<td align="center"><a href="portal_manageaccounts.php">Account Management Menu</a></td><td align="center"><a href="logout.php">Logout</a></td>';
					} else {
						echo '<td align="center"><a href="user_portal.php">Main Menu</a></td><td align="center"><a href="logout.php">Logout</a></td>';
					}
				?>
			</tr>
			<tr>
				<td>Username:</td>
				<?php
					if ($_SESSION['admin'] > 0){
						echo '<td><input type="text" value="' . $current_username . '" name="name" size="35" maxlength="35" /></td>';
					} else {
						echo '<td><input type="text" value="' . $current_username . '" name="name" size="35" maxlength="35" readonly/></td>';
					}
				?>
			</tr>
			<?php
				if ($_SESSION['admin'] == 1){
					echo '<tr>';
					echo '<td>Privilage Level:</td>';
					echo '<td>';
					echo '<select name="admin">';
					if ($current_privlevel == 0){ echo '<option value=0 selected>User</option>'; } else { echo '<option value=0>User</option>'; }
					if ($current_privlevel == 1){ echo '<option value=1 selected>Admin</option>'; } else { echo '<option value=1>Admin</option>'; }
					if ($current_privlevel == 2){ echo '<option value=2 selected>Moderator</option>'; } else { echo '<option value=2>Moderator</option>'; }
					echo '</select>';
                                        echo '</td>';
				} else {
					// avoid showing select menu to allow privilege change
				}
			?>
			<tr>
				<td>Realname:</td>
				<td><input type="text" value="<?php echo $current_realname; ?>" name="realname" size="35" maxlength="35" /></td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td><input type="text" value="<?php echo $current_gender; ?>" name="gender" size="35" maxlength="1" /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" value="<?php echo $current_password; ?>" name="password_sha512" size="35" maxlength="120" /></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" value="<?php echo $current_email; ?>" name="email" size="35" maxlength="255" /></td>
			</tr>
			<tr>
				<td>Country:</td>
				<td><input type="text" value="<?php echo $current_country; ?>" name="country" size="35" maxlength="2" /></td>
			</tr>
			<tr><td colspan="2" align="center"><input type="submit" value="Update" /></td></tr>
		<table>
	</form>
</body>
</html>
