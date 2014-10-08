<?php
	require '.config_commonfunctions';
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$inputedusername = trim($_POST["inputeduname"]);
                $inputedpassword = trim($_POST["inputedpword"]);
		if (empty($inputedusername)){ echo "<center>invalid username, please try again</center>"; exit; }
		if (empty($inputedpassword)){ echo "<center>invalid password, please try again<center>"; exit; }
		$accountactive = get_user_data($inputedusername,"active");

		if (getenv('HTTP_X_FORWARDED_FOR')) {
        		$pipaddress = getenv('HTTP_X_FORWARDED_FOR');
        		$ipaddress = getenv('REMOTE_ADDR');
    		} else {
        		$ipaddress = getenv('REMOTE_ADDR');
		}

		if ($accountactive == 1){
			$userdbpassword = get_user_data($inputedusername,"password_sha512");
			if (strpos(strtolower($userdbpassword),"fail") !== false){
				echo "<center>failed, unable to locate users password</center>";
				logfailedattempt($inputedusername,"unknown user,(" . $pipaddress . "->" . $ipaddress . ")");
				exit; 
			}
			$userssalt = trim(substr($userdbpassword,0,16));
			$inputedpasswordhash = crypt_password($inputedpassword,$userssalt);
			if (empty($inputedpasswordhash)){ echo "<center>failed, unable to decrypt user password</center>"; exit; }
			if (trim($userdbpassword) != trim($inputedpasswordhash)){ 
				echo "<center>incorrect password, please try again</center>"; 
				logfailedattempt($inputedusername,"bad password,(" . $pipaddress . "->" . $ipaddress . ")");
				exit; 
			}
			$useradminlevel = get_user_data($inputedusername,"admin");
			session_start();
	                $_SESSION['username'] = $inputedusername;
	                $_SESSION['timeout'] = 300;
	                $_SESSION['start'] = time();
			$_SESSION['admin'] = $useradminlevel;
			if ($useradminlevel > 0){ header('Location: admin_portal.php'); exit; }
			header('Location: user_portal.php');
			exit;
		} else {
			$doesuserexist = check_if_user_exists($inputedusername);
			if (empty($doesuserexist)){
				echo '<center>Account does not exist for username (' . $inputedusername . ')<br>Please try again<center>';
			} else {
				echo '<center>User account has not been activated yet.<br>Please follow the instructions sent to you after registration to enable your account.<br>Please <a href="http://www.woogerworks.com/index.php/let-us-know">contact us</a> for assistance</center>';
			}
		}
	}
?>
