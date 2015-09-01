<!DOCTYPE html>
<head>
<title>Servatrice Administrator</title>
</head>
<html>
    <body>
        <?php
            require '.auth_modsession';
            require '.config_commonfunctions';
            GLOBAL $configfile;
            $usertofind = $_POST['name'];
        ?>
        <table align="center" border="1" cellpadding="5">
                <table border="1" align="center" cellpadding="3">
                    <tr>
                        <td align="center" colspan="3"><a href="portal_banningsmanagement.php">Banning Management Menu</a></td>
                        <td align="center" colspan="2"><a href="logout.php">Logout</a></td>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Username</td>
                        <td>IP Address</td>
                        <td>Moderator</td>
                        <td>Created On</td>
                        <td>Duration</td>
                        <td>Reason</td>
                        <td>Displayed Reason</td>
                    </tr>
                    <?php
                        $dbserv = get_config_value($configfile,"dbserver");
                        $dbuser = get_config_value($configfile,"dbusername");
                        $dbpass = get_config_value($configfile,"dbpassword");
                        $dbname = get_config_value($configfile,"dbname");
                        $dbtable = get_config_value($configfile,"dbbantable");

                        if (strpos(strtolower($dbserv),"fail") !== false) return strtolower($dbserv);
                        if (strpos(strtolower($dbuser),"fail") !== false) return strtolower($dbuser);
                        if (strpos(strtolower($dbpass),"fail") !== false) return strtolower($dbpass);
                        if (strpos(strtolower($dbname),"fail") !== false) return strtolower($dbname);
                        if (strpos(strtolower($dbtable),"fail") !== false) return strtolower($dbtable);

                        $dbconnection = connect_to_database($dbserv,$dbuser,$dbpass,$dbname);
                        if (strpos(strtolower($dbconnection),"fail") !== false) return strtolower($dbconnection);

                        $usertofind = mysql_real_escape_string($usertofind);
                        
                        $query = mysql_query("SELECT * FROM `$dbtable` WHERE user_name = '$usertofind' ORDER BY time_from DESC") or die(mysql_error());

                        $i = 0;
                        while ($row = mysql_fetch_array($query))
                        {
                            $i++;
                            $moderatorname = locate_username_byid($row['id_admin']);
                            echo "<tr>
                                <form action=\"deleteban.php\" method=\"post\">
                                    <td align=\"center\"><input type=\"submit\" value=\"Delete\" /></td>
                                    <input type=\"hidden\" name=\"username\" value=\"{$row['user_name']}\">
                                    <input type=\"hidden\" name=\"starttime\" value=\"{$row['time_from']}\">
                                </form>
                                <form action=\"updateaban.php\" method=\"post\">
                                    <td align=\"center\"><input type=\"submit\" value=\"Update\" /></td>
                                    <td><input type=\"text\" name=\"username\" value=\"{$row['user_name']}\" size=\"35\" readonly></td>
                                    <td><input type=\"text\" name=\"ipaddress\" value=\"{$row['ip_address']}\" size=\"13\" readonly></td>
                                    <td><input type=\"text\" name=\"moderator\" value=\"$moderatorname\" size=\"15\" readonly></td>
                                    <td><input type=\"text\" name=\"starttime\" value=\"{$row['time_from']}\" size=\"20\" readonly></td>
                                    <td><input type=\"text\" name=\"minutes\" value=\"{$row['minutes']}\" size=\"4\" readonly></td>
                                    <td><input type=\"text\" name=\"reason\" value=\"{$row['reason']}\" size=\"255\" readonly></td>
                                    <td><input type=\"text\" name=\"visiblereason\" value=\"{$row['visible_reason']}\" size=\"255\" readonly></td>
                                </form>
                                </tr>";
                        }   
                        mysql_close($dbconnection);
                        echo "<tr><td colspan='9' align='left'>$i Total Bans</td></tr>";
                    ?>
                </table>
        </table>
    </body>
</html>