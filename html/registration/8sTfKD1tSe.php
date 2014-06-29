<!DOCTYPE html>
<head>
<title>Account Password Recovery</title>
</head>
<html>
<body>
<?php
require '../.config_commonfunctions';
$configfile = '../.config';
$results = update_user_table('JechtG89','password_sha512','JechtG89');
echo '<center>';
if ($results = 'success'){
echo 'Your account password has been reset to your username. Please log in to the account management web interface and update your password.<br>';
} else {
echo 'Password reset failed, please contact us</a> to change your password.<br>';
}
echo '</center>';
?>
</body>
</html>
