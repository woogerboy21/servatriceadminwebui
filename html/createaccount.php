<!DOCTYPE html>
<html>
<head>
<title>Servatrice Administrator</title>
</head>
    <body>
        <?php
            require '.config_commonfunctions';
            global $configfile;
        ?>
        <table align="center" border="1" cellpadding="5">
            <tr>
                <td align="center"><a href="loginpage.php">Account Log-in</a></td>
                <td align="center"><a href="index.php">Home</a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                        if ($_POST)
                        {
                            $username_to_reg = mysql_real_escape_string($_POST["nametoregister"]);
                            $pass_to_reg = mysql_real_escape_string($_POST["passwordtouse"]);
                            $email_to_reg = mysql_real_escape_string($_POST["emailtouse"]);

                            $username_has_valid_chars = preg_match('/^[\w-]+$/', $username_to_reg); // A-Z, a-z, 0-9, _, ., -
                            $username_has_bad_name = preg_match('/^Player_\d+$/', $username_to_reg); // Player_*
                            $username_has_double_punc = preg_match("/[.,_-]{2,}/", $username_to_reg); // Has no double punc (i.e. cant be 'steve._milk')
                            $username_starts_with_let_or_num = is_numeric($username_to_reg[0]) || ctype_alpha($username_to_reg[0]); // Starts w/ letter or num

                            if (empty($username_to_reg) || empty($pass_to_reg) || empty($email_to_reg))
                            {
                                echo "All fields are required";
                            }
                            else if ($username_has_valid_chars && $username_has_bad_name === 0 && !$username_has_double_punc && $username_starts_with_let_or_num)
                            {
                                echo add_user($username_to_reg, $pass_to_reg, $email_to_reg);
                            }
                            else
                            {
                                echo "You may only use <b>A-Z, a-z, 0-9, _,</b> and <b>-</b> in your username. In addition, your username can't start with \"Player_\"<br/>\n";
                            }
                        }
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>
