<?php
    require('globals.php');

    $faulty = FALSE;

    if ($_POST['username'] == $globAdminName && $_POST['password']==$globAdminPassword) {
        session_start();
        $_SESSION['auth'] = "ok";
        header('Location: loggedin.php');
        die();
    } else if (isset($_POST['username'])) {
        $faulty = TRUE;
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gothia Open 2012 login</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<form method="POST" action="login.php">
    <table>
        <tr>
            <td>
                Användarnamn:
            </td>
            <td>
                <input type="text" name="username" value="<?php echo "$_POST[username]" ?>">
            </td>
        </tr>
        <tr>
            <td>
                Lösenord:
            </td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>
    </table>

    <input type="submit" value="Logga in"> <?php if ($faulty) echo '<span style="color:rgb(255,0,0)">Felaktiga uppgifter</span>'; ?>
</form>                                         
</body>
</html>

