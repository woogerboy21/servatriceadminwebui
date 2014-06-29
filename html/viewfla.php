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
                        $flafile = get_config_value($configfile,"failedloginattemptlog");

		?>
                <table align="center" border="1" cellpadding="5">
                        <tr>
                                <td align="center"><a href="portal_servermanagement.php">Server Management Menu</a></td>
                                <td align="center"><a href="logout.php">Logout</a></td>
                        </tr>
                        <tr>
                                <td colspan="2">
					<?php include $flafile; ?>
				</td>
			</tr>
		</table>
	</body>
</html>
