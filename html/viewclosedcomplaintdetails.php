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
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$dbserv = get_config_value($configfile,"dbserver");
				$dbuser = get_config_value($configfile,"dbusername");
				$dbpass = get_config_value($configfile,"dbpassword");
				$dbname = get_config_value($configfile,"dbname");
				$dbtable = get_config_value($configfile,"dbcoctable");
				if (strpos(strtolower($dbserv),"fail") !== false){ $results = strtolower($dbserv); return $results; exit; }
				if (strpos(strtolower($dbuser),"fail") !== false){ $results = strtolower($dbuser); return $results; exit; }
				if (strpos(strtolower($dbpass),"fail") !== false){ $results = strtolower($dbpass); return $results; exit; }
				if (strpos(strtolower($dbname),"fail") !== false){ $results = strtolower($dbname); return $results; exit; }
				if (strpos(strtolower($dbtable),"fail") !== false){ $results = strtolower($dbtable); return $results; exit; }
				$dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
				if (strpos(strtolower($dbconnection),"fail") !== false){ $results = strtolower($dbconnection); return $results; exit; }
                	        $query = mysql_query("SELECT * FROM " . $dbtable . " WHERE id='" . $_POST['messageid'] . "'" );
				if (!query){ $results = "failed, " . mysql_error(); return $results; exit; }
				while ($row = mysql_fetch_array($query)){
					$userfrom = $row['userfrom'];
					$userabout = $row['userabout'];
					$dateofproblem = $row['dtofproblem'];
					$datereported = $row['datereported'];
					$gamenumber = $row['gamenumber'];
					$summary = $row['briefdescription'];
					$description = $row['message'];
					$moderator = $row['moderator'];
					$modnotes = $row['modnotes'];
					$closingmod = $row['closingmod'];
					$dateresolved = $row['dateresolved'];
					$screenshoturl = $row['screenshoturl'];
					$closingverdict = $row['closingverdict'];
				}
				mysql_close($dbconnection);
			}
		?>
		<table align="center" border="1" cellpadding="5">
			<tr>
				<td align="center"><a href="viewallclosedcomplaints.php">View Closed Complaints</a></td>
				<td align="center"><a href="logout.php">Logout</a></td>
			</tr>
			<?php
                                if (empty($_POST['messageid'])){ echo '<tr><td align="center" colspan="2">Please select a complaint to view.</td></tr>'; exit; }
                        ?>
			<form action="" method="post">
				<tr><td>Report Number</td><td><input type="text" size="67" name="messageid" value="<?php echo $_POST['messageid']; ?>" readonly /></input></td></tr>
				<tr><td>From</td><td><input type="text" size="67" name="from" value="<?php echo $userfrom; ?>" readonly /></td></tr>
				<tr><td>About</td><td><input type="text" size="67" name="about" value="<?php echo $userabout; ?>" readonly /></td></tr>
				<tr><td>Date of Problem</td><td><input size="67" type="text" name="dateofprob" value="<?php echo $dateofproblem; ?>" readonly /></td></tr>
				<tr><td>Date Reported</td><td><input size="67" type="text" name="datereported" value="<?php echo $datereported; ?>" readonly /></td></tr>
				<tr><td>Game Number</td><td><input type="text" size="67" name="gamenumber" value="<?php echo $gamenumber; ?>" readonly /></td></tr>
				<tr><td>Summary</td><td><input type="text" size="67" name="summary" value="<?php echo $summary; ?>" readonly /></td></tr>
				<tr><td>User Description</td><td><textarea col="50" rows="20" maxlength="1024" name="description" readonly /><?php echo $description; ?></textarea></tr>
				<tr><td>Screenshot URL</td><td><input type="text" size="67" name="screenshoturl" value="<?php echo $screenshoturl; ?>" readonly /></td></tr>
				<tr><td>Owning Moderator</td><td><input type="text" size="67" name="moderator" value="<?php echo $moderator; ?>" readonly /></td></tr>
				<tr><td>Moderator Notes</td><td><textarea cols="50" rows="20" maxlength="1024" name="modnotes" readonly /><?php echo $modnotes; ?></textarea></td></tr>
				<tr><td>Closing Moderator</td><td><input type="text" size="67" name="closingmod" value="<?php echo $closingmod; ?>" readonly /></td></tr>
				<tr><td>Date Resolved</td><td><input type="text" size="67" name="dateresolved" value="<?php echo $dateresolved; ?>" readonly /></td></tr>
				<tr><td>Closing Verdict</td><td><input type="text" size="67" name="closingverdict" value="<?php echo $closingverdict; ?>" readonly /></td></tr>
			</form>
		</table>
	</body>
</html>
