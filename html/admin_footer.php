<?php
	require '.auth_modsession';
	echo '<tr>';
        echo '<td align="center">' .  $_SESSION['username'] . '</td>';
        if ($_SESSION['admin'] == 1){ echo '<td align="center" colspan="2">Administrator</td>'; }
        if ($_SESSION['admin'] == 2){ echo '<td align="center" colspan="2">Moderator</td>'; }
        echo '</tr>';
?>
