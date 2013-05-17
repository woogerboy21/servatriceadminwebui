<!DOCTYPE html>
<header>
<title>Servatrice Administrator</title>
</header>
<html>
	<body>
		<?php
			require '.auth_modsession';
			require '.config_commonfunctions';
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){ $user = $_POST['username']; }
			if (empty($user)){ echo "failed, user name can not be blank"; exit; }
			if ($_POST['online']){ $state = "online"; } else { $state = "offline"; }
			$id = get_session_data($user,"id",$state);
			$user_name = get_session_data($user,"user_name",$state);
			$id_server = get_session_data($user,"id_server",$state);
			$ip_address = get_session_data($user,"ip_address",$state);
			$start_time = get_session_data($user,"start_time",$state);
			$end_time = get_session_data($user,"end_time",$state);
		?>
		
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="portal_sessionsmanagement.php">Session Management Menu</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<tr><td>Name:</td><td><?php echo $user_name ?></td></tr>
			<tr><td>ID Server:</td><td><?php echo $id_server ?></td></tr>
			<tr><td>IP Address:</td><td><?php echo $ip_address ?></td></tr>
			<tr><td>Start Time:</td><td><?php echo $start_time ?></td></tr>
			<tr><td>End Time:</td><td><?php echo $end_time ?></td></tr>
		</table>
	</body>
</html>
