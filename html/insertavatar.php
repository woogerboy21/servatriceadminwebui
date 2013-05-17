<?php
	require '.auth_usersession';
        require '.config_commonfunctions';
	$usersname = "wooger";
	$imagename = "/tmp/avatar_2710_1325557131.png";
	$results = insert_avatar($imagename,$usersname);
	echo $results;
?>
