<html>
<body>
<table align="center" border="1" cellpadding="5">
	<tr>
        	<?php
			require '.auth_usersession';
		        require '.config_commonfunctions';
		        global $configfile;
       	        	if ($_SESSION['admin'] > 0){
               			echo '<td align="center" ><a href="portal_manageaccounts.php">Account Management Menu</a></td>';
                	} else {
                		echo '<td align="center" ><a href="user_portal.php">Main Menu</a></td>';
                	}
                ?>
                <td align="center"><a href="logout.php">Logout</a></td>
        </tr>
	<tr>
		<td align="center" colspan="2">
		<?php
			$results = "unknown";
			echo $_SESSION['username'] . "<br>";
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$extension = end(explode(".", $_FILES["file"]["name"]));
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 5000)
			&& in_array($extension, $allowedExts))
		  	{
  				if ($_FILES["file"]["error"] > 0)
		    		{
    					echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		    		}
  				else
		    		{
    					echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		    			echo "Type: " . $_FILES["file"]["type"] . "<br>";
    					echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		    			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    					if (file_exists("/tmp/" . $_FILES["file"]["name"]))
		      			{
      						echo $_FILES["file"]["name"] . " already exists. ";
		      			}
    					else
		      			{
//      			move_uploaded_file($_FILES["file"]["tmp_name"],"/tmp/" . $_FILES["file"]["name"]);
//      			echo "Stored in: " . "/tmp/" . $_FILES["file"]["name"];
						$results = insert_avatar($_FILES["file"]["tmp_name"],$_SESSION['username']);
						echo $results . "<br>";
      					}
		    		}
		  	}
			else
		  	{
  				echo "Invalid file, please check file and retry.<br>";
				echo "Possible problems could be file type or size.<br>";
		  	}
		?> 
		</td>
	</tr>
</table>
</body>
</html>
