<?php
	require '.config_commonfunctions';
	global $configfile;
	$serverid = get_config_value($configfile,"serverid");
	$enabled = get_config_value($configfile,"statsenabled");
	$timezone = get_config_value($configfile,"timezone");
        date_default_timezone_set($timezone);
	$refreshtime = get_config_value($configfile,"statisticsrefreshtime");
	if (trim(strtolower($enabled)) == "yes"){
		$rxtxratecalc = 1000;
		$databaseserver = trim(get_config_value($configfile,'dbserver'));
		if (strpos(strtolower($databaseserver),"fail") !== false){ echo "failed to determine database server"; exit; }
		$databaseusername = trim(get_config_value($configfile,'dbusername'));
		if (strpos(strtolower($databaseusername),"fail") !== false){ echo "failed to determine database user name"; exit; }
		$databasepassword = trim(get_config_value($configfile,'dbpassword'));
		if (strpos(strtolower($databasepassword),"fail") !== false){ echo "failed to determine database user password"; exit; }
		$databasetouse = trim(get_config_value($configfile,'dbname'));
		if (strpos(strtolower($databasetouse),"fail") !== false){ echo "failed to determine database to use"; exit; }
		$uptimetable = trim(get_config_value($configfile,'dbuptimetable'));
		if (strpos(strtolower($uptimetable),"fail") !== false){ echo "failed to determine database table to use"; exit; }
		$timezone = trim(get_config_value($configfile,'timezone'));
		if (strpos(strtolower($timezone),"fail") !== false){ echo "failed to determine time zone to use"; exit; }
		//date_default_timezone_set($timezone);
		if (empty($currentdate)){ $currentdate = date('Y-m-d'); }
		if (empty($currenthour)){ $currenthour = date('H');  }
	                      
		echo '<html>';
		echo '  <head>';
		echo '      <script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		echo '          <script type="text/javascript">';
		echo '                google.load("visualization", "1", {packages:["corechart"]});';
		echo '                google.setOnLoadCallback(drawChart);';
		echo '                function drawChart() {';
		echo '                    var data = google.visualization.arrayToDataTable([';
		echo '                    [\'Time\', \'TX_Rate\', \'RX_Rate\'],';


		$dbconnection = connect_to_database($databaseserver,$databaseusername,$databasepassword,$databasetouse);
		$query = mysql_query("SELECT * FROM " . $uptimetable . " WHERE timest LIKE '" . $currentdate . " " . $currenthour . "%' AND id_server = " . $serverid);
		while ($row = mysql_fetch_array($query)){
			echo '[\'' . date_format(date_create($row['timest']), 'h:i:s A') . '\',' . ($row['tx_bytes'] / $rxtxratecalc) . ',' . ($row['rx_bytes'] / $rxtxratecalc) . '],';
		}

		$query = mysql_query("SELECT MAX(timest) FROM " . $uptimetable . " WHERE timest LIKE '" . $currentdate . " " . $currenthour . "%'");
		mysql_close($dbconnection);                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                                                                                                                                                                                                                                                       
		echo '                    ]);';
		echo '                        ';                                                                      
		echo '                    var options = {';
		echo '                    title: \'Rx/Tx Rate Statistics (Kbytes) for [' . $currentdate . '] \'';
		echo '                    };';
		echo '                       ';                                                                                                 
		echo '                    var chart = new google.visualization.LineChart(document.getElementById(\'chart_div\'));';
		echo '                    chart.draw(data, options);';
		echo '                }';
		echo '          </script>';
		echo '          <meta http-equiv="refresh" content="' . $refreshtime . '" >';
		echo '   </head>';
		echo '   <body>';
		echo '	      <center>';
		echo '        <div id="chart_div" style="width: 500px; height: 400px;"></div>';
		echo '        </center>';
		echo '   </body>';
		echo '</html>';
	} else {
		echo "<center><b>Server Statistics Disabled<br>Check Back Soon</b></center>";	
	}
?>
