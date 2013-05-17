<html>
	<body>
		<table border="1" cellpadding="6" align="center">
			<?php
				require '.auth_usersession';
	                        require '.config_commonfunctions';
				global $configfile;
                		$dbserver = get_config_value($configfile,"dbserver");
		       	        $dbusername = get_config_value($configfile,"dbusername");
	        		$dbpassword = get_config_value($configfile,"dbpassword");
		       	        $dbname = get_config_value($configfile,"dbname");
                		$dbtable = get_config_value($configfile,"dbsessiontable");
		                $dbusertable = get_config_value($configfile,"dbusertable");
        	  		if (empty($dbserver)){ echo "<center>failed to connect to database server, unknown server name</center>"; exit; }
		               	if (empty($dbusername)){ echo "<center>failed to connect to database server, unknown database user name</center>"; exit; }
	               		if (empty($dbpassword)){ echo "<center>failed to connect to database server, unknown database user name password</center>"; exit; }
		       	        if (empty($dbname)){ echo "<center>failed to connect to database server, unknown database name</center>"; exit; }
              			if (empty($dbtable)){ echo "<center>failed to connect to database server, unknown database table name</center>"; exit; }
		                if (empty($dbusertable)){ echo "<center>failed to connect to database server, unknown user database table</center>"; exit; }
        			$dbconnection = connect_to_database($dbserver,$dbusername,$dbpassword,$dbname);
		               	if (strpos(strtolower($dbconnection),"fail") !== false){ echo "failed, " . mysql_error(); exit; }
	               		$query = mysql_query("SELECT name  FROM " . trim($dbusertable) . " WHERE admin != 0");
		       	        if ($query){ $results = "success"; } else { echo "failed, " . mysql_error(); }
                		while ($row = mysql_fetch_array($query)){
		                        $query2 = mysql_query("SELECT * FROM " . trim($dbtable) . " WHERE user_name = '" . $row['name'] . "' AND end_time is NULL");
	    	      			while ($row2 = mysql_fetch_array($query2)){ 
						echo "<tr><td>" . $row2['user_name'] . "</td></tr>";
					}
		                }
		       	        mysql_close($dbconnection);
			?>
		</table>
	</body>
</html>
