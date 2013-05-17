<?php
	require '.auth_modsession';
	global $configfile;
        $urgentmessage = trim(get_config_value($configfile,'adminportalurgentmessage'));
	if (!empty($urgentmessage)){
        	echo '<tr>';
                echo '<td align="center" colspan="3">';
                echo $urgentmessage;
                echo '</td>';
                echo '</tr>';
        }
?>
