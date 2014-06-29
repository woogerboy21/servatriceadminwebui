<?php

	$currentpass = $_GET['password'];
	$cryptpass = crypt_password($currentpass,'');
	echo $currentpass . '<br />';
	echo $cryptpass . '<br />';

	function crypt_password($password, $salt = ''){
                if ($salt == '') {
                        $saltChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                        for ($i = 0; $i < 16; ++$i)
                        $salt .= $saltChars[rand(0, strlen($saltChars) - 1)];
                }
                $key = $salt . $password;
                for ($i = 0; $i < 1000; ++$i)
                $key = hash('sha512', $key, true);
                return $salt . base64_encode($key);
        }

?>
