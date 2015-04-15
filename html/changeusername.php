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
            <td><input type="text" name="new" maxlength="20" placeHolder="New Username"></td>
        </tr>
        <tr>
            <td><input type="password" name="hash" placeHolder="Current Password"></td>
        </tr>
        <tr>
            <td colspan="2" style="min-width:400px">
                <input type="submit" value="Change Username" style="width:150px">
            </td>
        </tr>
    </table>
    </form>
    <br/><br/>
    <font color="red"><?php if ($_POST) echo change_username($_POST['cur'], $_POST['new'], $_POST['hash']); ?></font>
    </center>
</body>
</html>
