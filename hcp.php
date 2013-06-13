<?php
    session_start();
    require('verify_loggedin.php');
    defaultCheckLoggedIn();
    
    if (isset($_GET['hcp']) && isset($_GET['id'])) {
        $state = "done";
    } else if (isset($_GET['id'])) {
        $state = "sethcp";
    } else {
        $state = "chooseplayer";
    }
    
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
<p>
    <a href="loggedin.php">Tillbaka</a>
</p>

<?php
    if ($state == "done") {
        setPlayerHcp($_GET['id'], $_GET['hcp']);
        $player = getPlayerInfo($_GET['id']);
        echo "<p style='color:rgb(255,0,0)'>Ok, hcp satt till $player[hcp] för $player[firstname] $player[lastname] ($player[club]).</p>";
    }

?>

<form method="get" action="hcp.php">

<p>

Välj spelare: <select name="id">

<?php
    
    $players = getAllPlayers();
    foreach ($players as $player) {
        echo "<option value=\"$player[id]\" ". ($playerChosen && $player['id']==$_GET['id'] ? " selected=\"selected\" " : "") .">$player[firstname] $player[lastname], $player[club]</option>";
    }  
?>
</select>

<input type="submit" value="OK">
</form>
</p>
<?php

if ($state == "sethcp") {
$player = getPlayerInfo($_GET['id']);
echo "
<form method=\"get\" action=\"hcp.php\">
<input type=\"hidden\" name=\"id\" value=\"$_GET[id]\">
<p>

<table>

    <tr>
        <td>
            Spelare
        </td>
        <td>
            Nuvarande hcp
        </td>
        <td>
            Ändra till
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            $player[firstname] $player[lastname], $player[club]
        </td>
        <td style=\"text-align:center\">
            $player[hcp]
        </td>
        <td>
            <input type=\"text\" name=\"hcp\" size=\"3\">
        </td>
        <td>
            <input type=\"submit\" value=\"Ändra!\">
        </td>
    </tr>
</table>

</p>";
}

?>

</form>

</body>
</html>
