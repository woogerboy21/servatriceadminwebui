<!DOCTYPE HTML>
<head>
    <title>Servatrice Administrator</title>
    <meta name="author" content="Zach H (ZeldaZach)">
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-8"> 
    <style> td {text-align:center;} </style>
    <?php
        require '.config_commonfunctions';
        global $configfile; 
    ?>
</head>
<body>
    <center>
    <form method="POST">
    <table border="0">
        <tr>
            <td><input type="text" name="cur" placeHolder="Current Username"></td>
        </tr>
        <tr>
            <td><input type="text" name="new" maxlength="30" placeHolder="New Username"></td>
        </tr>
        <tr>
            <td><input type="password" name="hash" placeHolder="Current Password"></td>
        </tr>
        <tr>
            <td colspan="2" style="min-width:400px">
                <input type="submit" value="Change Username" style="width:150px">
            </td>
        </tr>
        <tr>
            <td>
                <div style="text-align:left;">
                    <ul>
                        <li>You may use any of the following characters in your name: A-Z, a-z, 0-9, _, -, and .</li>
                        <li>You may only have up to 30 characters in your new username</li>
						<li>You may only change your username if your old username was invalid</li>
                        <li>You may only change your username <u>once</u></li>
                    </ul>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <font color="red"><?php if ($_POST) echo "<hr width='50%'>" . change_username($_POST['cur'], $_POST['new'], $_POST['hash']); ?></font>
            </td>
        </tr>
    </table>
    </form>
    <br/><br/>
    
    </center>
</body>
</html>
