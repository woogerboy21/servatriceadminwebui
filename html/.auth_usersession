<?php
                session_start();
				$current_file =  basename($_SERVER['PHP_SELF']);
				
                if (!isset($_SESSION['username'])) {
                        echo "<center>Please <a href=\"loginpage.php?redirect=$current_file\">login</a> to continue</center>";
                        header("refresh 3: url=loginpage.php?redirect=$current_file)");
                        exit;
                }

                if (isset($_SESSION['start'])) {
                        $sessionlife = time() - $_SESSION['start'];
                        if ($sessionlife > $_SESSION['timeout']){
                                echo "<center>Session Timeout<br>Please logout and <a href=\"loginpage.php?redirect=$current_file\">re-login</a> to continue</center>";
                                exit;
                        } else {
                                $_SESSION['start'] = time();
                        }
                } else {
                        echo "<center>Please <a href=\"loginpage.php?redirect=$current_file\">login</a> to continue</center>";
                        header("refresh 3: url=loginpage.php?redirect=$current_file)");
                     exit;
                }
?>
