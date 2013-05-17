<?php
	require '.auth_usersession';
	global $configfile;
        $urgentmessage = trim(get_config_value($configfile,'userportalurgentmessage'));
	if (!empty($urgentmessage)){
        	echo '<tr>';
                echo '<td align="center" colspan="3">';
                echo $urgentmessage;
                echo '</td>';
                echo '</tr>';
        }
?>
