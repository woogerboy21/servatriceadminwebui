<!DOCTYPE html>
<head>
<title>Account Verification</title>
</head>
<html>
<body>
<?php
require '../.config_commonfunctions';
$configfile = '../.config';
$activateresults = update_user_table('Mono789','active','1');
echo '<center>';
if ($activateresults = 'success'){
echo 'Your account has now been verified, you should be able to log into the servatrice server using your registered account name.<br>';
} else {
echo 'Account activation failed, please contact us to activate your account';
}
echo '</center>';
?>
</body>
</html>
