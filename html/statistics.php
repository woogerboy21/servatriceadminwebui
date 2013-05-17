<html>
	<head><title>Servatrice Server Statistics</title></head>
	<body>
		<table border="1" align="center" >
			<?php
				session_start();
				if (is_null($_SESSION['admin'])){ echo '<tr><td align="center" colspan="5"><a href="index.php">Home</a></td></tr>'; }
				if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){ echo '<tr><td align="center" colspan="5"><a href="user_portal.php">Main Menu</a></td></tr>'; }
				if ($_SESSION['admin'] > 0){ echo '<tr><td align="center" colspan="5"><a href="admin_portal.php">Administration Menu</a></td></tr>'; }
				$currentdate = $_GET['date'];
			?>
			<tr>
				<td align="center"><a href="./statistics_usersgameshourly.php" target="chart">Users/Games Hourly</a></td>
				<td align="center"><a href="./statistics_usersgamesdaily.php<?php echo "?date=" . $currentdate ?>" target="chart">Users/Games Daily</a></td>
				<td align="center"><a href="./statistics_usersgamesovernight.php" target="chart">Users/Games Overnight</a></td>
				<td align="center"><a href="./statistics_rxtxhourly.php" target="chart">Rx/Tx Hourly</a></td>
				<td align="center"><a href="./statistics_rxtxdaily.php<?php echo "?date=" . $currentdate ?>" target="chart">Rx/Tx Daily</a></td>
			</tr>
			<tr>
				<td>
					<?php
						$found = strrpos($_SERVER['HTTP_USER_AGENT'],"MSIE");
						if ($found == true){
							echo '<tr><td colspan="5" align="center">IE Unsupported Browser ( Try <a href="http://www.mozilla.org/en-US/firefox/new/">FireFox</a> )</td></tr>';
						} else {
							echo '<tr><td colspan="5"><iframe name="chart" src="./statistics_usersgameshourly.php" width="950" height="575"></iframe></td></tr>';
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
