<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
	<body>
		<?php
			require '.config_commonfunctions';
			global $configfile;
			$version = trim(get_config_value($configfile,'version'));
			if (strpos(strtolower($version),"fail") !== false){ echo $version; exit; }
			$banner = trim(get_config_value($configfile,'indexwelcomemessage'));
			if (strpos(strtolower($banner),"fail") !== false){ echo $banner; exit; }
		?>
		<table border="1" align="center" cellpadding="5">
			<tr align="center">
				<td><a href="loginpage.php">Account Log-in</a></td>
				<td><a href="statistics.php">Statistics</a></td>
				<td><a href="registrationpage.php">Registration</a></td>
				<td><a href="codeofconduct.html">Code of Conduct</a></td>
			</tr>
			<tr><td colspan="4" align="center"><?php if (!empty($banner)){ echo trim($banner) . '<br>'; } ?></td></tr>
			<tr><td colspan="4"><?php echo '<font size="1">v.' . trim($version) . '</font>'; ?></td></tr>	
		</table>
	</body>
</html>
