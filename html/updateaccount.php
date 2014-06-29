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
							if (!empty($_POST['id'])){
								$results = update_user_table($_POST['name'],"id",trim($_POST['id']));
                                                                if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (empty($_POST['admin'])){
								if ($_SESSION['admin'] == 1){
									$results = update_user_table($_POST['name'],"admin",trim($_POST['admin']));
	                                                                if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
								}
							}
							if (!empty($_POST['admin'])){
								$results = update_user_table($_POST['name'],"admin",trim($_POST['admin']));
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['name'])){
								$results = update_user_table($_POST['name'],"name",trim($_POST['name']));
                                                                if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['realname'])){
								$results = update_user_table($_POST['name'],"realname",trim($_POST['realname']));
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['gender'])){
								$results = update_user_table($_POST['name'],"gender",trim($_POST['gender']));
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['password_sha512'])){
                                                                $results = update_user_table($_POST['name'],"password_sha512",trim($_POST['password_sha512']));
                                                                if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
                                                        }
							if (!empty($_POST['email'])){
								$results = update_user_table($_POST['name'],"email",trim($_POST['email']));
								if (strpos(strtolower($results),"fail") !== false){ echo $reults; exit; }
							}
							if (!empty($_POST['country'])){
								$results = update_user_table($_POST['name'],"country",trim($_POST['country']));
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['avatar_bmp'])){
								$results = update_user_table($_POST['name'],"avatar_bmp",trim($_POST['avatar_bmp']));
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['registrationDate'])){
								$results = update_user_table($_POST['name'],"registrationDate",trim($_POST['registrationDate']));
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (isset($_POST['active'])){
								$results = update_user_table($_POST['name'],"active",$_POST['active']);
                                                                if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['token'])){
								$results = update_user_table($_POST['name'],"token",trim($_POST['token']));
                                                                if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (isset($_POST['deleteavatar'])) {
								$results = delete_avatar($_POST['name']);
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							if (!empty($_POST['adminnotes'])) {
								$results = update_user_table($_POST['name'],"adminnotes",trim($_POST['adminnotes']));
								if (strpos(strtolower($results),"fail") !== false){ echo $results; exit; }
							}
							echo "User account updated";
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
