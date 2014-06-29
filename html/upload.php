<html>
<body>
<table align="center" border="1" cellpadding="5">
	<tr>
        	<?php
		require '.auth_usersession';
		require '.config_commonfunctions';
       	        if ($_SESSION['admin'] > 0){
               		echo '<td align="center"><a href="portal_manageaccounts.php">Account Management Menu</a></td>';
               	} else {
                	echo '<td align="center"><a href="manageaccount.php">Manage Account</a></td>';
                }
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $usersname = $_POST['name'];
                } else {
                        $usersname = $_SESSION['name'];
                }
	?>
		<tr>
		<td colspan="2" align="center">
	<?php
			$uploaddir = '/tmp/';
			$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
			echo "<p>";
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  			echo "File is valid, and was successfully uploaded.\n";
			$imagename = $uploadfile;
			$results = insert_avatar($imagename,$usersname);
			include update_avatar.php;
			} else {
   			echo "Upload failed.\n The file is either not of a supported file type (jpg) or is too large (64KB max).";
			}
	?>
		</td>
		</tr>
                 <td align="center"><a href="logout.php">Logout</a></td>
        </tr>
</table>
</body>
</html>
