<?php
    session_start();
    require('verify_loggedin.php');
    defaultCheckLoggedIn();
    
    require('db/dbfuncs.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gothia Open 2012 login</title>
<!--<link href="style.css" rel="stylesheet" type="text/css" media="screen" />-->
</head>
<body>
<form action="showsquadinfo.php" method="get">

<p>
    <a href="loggedin.php">Tillbaka</a>
</p>

<p>
    Välj start: <select name="squad">
    
<?php

    $squads = getSquadInfo();
    foreach ($squads as $squad) {
        if ($squad['cancelled']!=1) {
            echo "<option value=\"$squad[day]$squad[time]\">". utf8_encode($squad['info']) ."</option>";
        }
    }

?>

</select>

<input type="submit" value="Välj">

</p>

<form>
</body>
</html>
