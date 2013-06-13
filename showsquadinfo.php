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
    <a href="getsquadinfo.php">Tillbaka</a>
</p>

<h1><?php echo utf8_encode(getSquadInfoLine(substr($_GET['squad'],0,6),substr($_GET['squad'],6,4))) ?></h1>

<table>
    <tr>
        <th>
            Spelare
        </th>
        <th>
            Klubb
        </th>
        <th>
            Hcp
        </th>
        <th>
            E-mail
        </th>
        <th>
            Telefonnummer
        </th>
        <th>
            Chansen?
        </th>
        <th>
            Betalat?
        </th>
    </tr>


<?php

    $players = getSquadPlayersInfo(substr($_GET['squad'],0,6),substr($_GET['squad'],6,4));
    foreach ($players as $player) {
        $reentrystring = $player['squadnumber'] == 2 ? "(R)" : ($player['squadnumber']==3 ? "(Rx2)" : "");
        echo "
        <tr>
            <td>
                $player[firstname] $player[lastname] $reentrystring
            </td>
            <td>
                $player[club]
            </td>
            <td>
                $player[hcp]
            </td>
            <td>
                $player[email]
            </td>
            <td>
                $player[phonenumber]
            </td>
            <td>
                JA / NEJ
            </td>
            <td>
                [&nbsp;&nbsp;&nbsp;]
            </td>
        </tr>";
    }

?>

</table>

</body>
</html>
