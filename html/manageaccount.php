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
			$current_email = $_POST['useremail'];
			if (empty($current_username)){
				$current_username = locate_username_byemail($current_email);
			}
		} else {
			$current_username = $_SESSION['username'];
		}
		$current_privlevel = get_user_data($current_username,'admin');
		$current_realname = get_user_data($current_username,'realname');
		$current_gender = get_user_data($current_username,'gender');
		$current_email = get_user_data($current_username,'email');
		$current_country = get_user_data($current_username,'country');
		$current_avatar = get_user_data($current_username,'avatar_bmp');
		$current_active = get_user_data($current_username,'active');
		$current_adminnotes = get_user_data($current_username,'adminnotes');

	?>
	<form action="updateaccount.php" method="post">
		<table align="center" border="1" cellpadding="5" width="450">
			<tr>
				<?php
					if ($_SESSION['admin'] > 0){
						echo '<td align="center"><a href="portal_manageaccounts.php">Account Management Menu</a></td><td align="center"><a href="logout.php">Logout</a></td>';
					} else {
						echo '<td align="center"><a href="user_portal.php">Main Menu</a></td><td align="center"><a href="logout.php">Logout</a></td>';
					}
				?>
			</tr>
			<?php
				if ($_SESSION['admin'] > 0){
					echo '<tr>';
					echo '<td>Active:</td>';
					echo '<td>';
					echo '<select name="active">';
					if ($current_active == 0){ echo '<option value=0 selected>No</option>'; } else { echo '<option value=0>No</option>'; }
					if ($current_active == 1){ echo '<option value=1 selected>Yes</option>'; } else { echo '<option value=1>Yes</option>'; }
					echo '</select>';
					echo '</td>';
					echo '</tr>';
				}
			?>
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
			<tr>
				<td>Current Avatar:</td>
				<td><?php
				echo '<img src="data:image/png;base64,' . base64_encode( $current_avatar ) . '" />';
				?></td>
			</tr>
			<tr>
				<td>Delete Avatar:</td>
				<td><input type="checkbox" value="" name="deleteavatar" /></td>
			</tr>
			<?php
                                if ($_SESSION['admin'] > 0){
					echo '<tr>';
					echo '<td>Admin Notes:</td>';
					echo '<td>';
					echo '<textarea name="adminnotes" rows="8" cols="35" />' . $current_adminnotes . '</textarea>';
					echo '</td>';
					echo '</tr>';
				}
			?>	
			<tr><td colspan="2" align="center"><input type="submit" value="Update" /></td></tr>
		<table>
	</form>
	<form enctype="multipart/form-data" action="upload.php" method="POST">
		<table align="center" border="1" cellpadding="5" width="450">
			<tr>
				<td>Upload Avatar</td>
			</tr>
			<tr>
				<td>
					<?php 
						echo '<input type="hidden" name="name" value="' . $current_username . '" />';
					 ?>
			                <input type="hidden" name="MAX_FILE_SIZE" value="65536" />
			                Maximum filesize is 64KB. <br>
			                For best results, your avatar pictures should be in aspect ratio 5:2! <br>
			                <input name="userfile" type="file" />
				        <input type="submit" value="Send File" />
				</td>
			</tr>
		</table>
        </form>
	<?php
                if ($_SESSION['admin'] > 0){
			echo '<table align="center" border="1" cellpadding="5" width="450">';
                        echo '<tr>';
                        echo '<td>';
                        echo '<form action="resendemailverification.php" method="post" />';
                        echo '<input type="hidden" name="name" value="' . $current_username . '" />';
                        echo '<center><input type="submit" value="Resend Email Verification" /></center>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
			echo '</table>';
                }
        ?>
</body>
</html>
