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
			$uptimerowcount = get_uptimedatacount();
		?>
		<form action="deleteuptimedata.php" method="post">
			<table align="center" border="1" cellpadding="5">
				<tr>
					<td align="center"><a href="portal_servermanagement.php">Server Management Menu</a></td>
					<td align="center"><a href="logout.php">Logout</a></td>
				</tr>
				<tr>
					<td>Uptime Row Count:</td>
					<td><?php echo $uptimerowcount; ?></td>
				</tr>
				<tr>
					<td>Uptime Rows to Delete:</td>
					<td>
				        	<select name="count">
				        		<option value=1>1</option>
					                <option value=10>10</option>
					        	<option value=100>100</option>
					                <option value=1000>1,000</option>
					                <option value=10000>10,000</option>
					                <option value=100000>100,000</option>
					                <option value="all">All</option>
				                </select>
                                        </td>
				</tr>
				<tr><td align="center" colspan="2"><input type="submit" value="Delete" /></td></tr>
			</table>
		</form>
	</body>
</html>
