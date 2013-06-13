<?php
    session_start();
    require('verify_loggedin.php');
    defaultCheckLoggedIn();
    
    require('db/dbfuncs.php');
    
    if (isset($_GET['squad'])) {
        $day = substr($_GET['squad'],0,6);
        $time = substr($_GET['squad'],6,4);
    } else if (isset($_POST['squad'])) {
        $day = substr($_POST['squad'],0,6);
        $time = substr($_POST['squad'],6,4);
        
        // report results
        $players = getSquadPlayers($day,$time);

        foreach ($players as $player) {
            $id = $player['id'];
            $res = registerResult($day,$time,$id,array($_POST["s1_$id"],$_POST["s2_$id"],
                        $_POST["s3_$id"],$_POST["s4_$id"],$_POST["s5_$id"],$_POST["s6_$id"]),$_POST["chansen_$id"]=="on"?1:0);
            if ($res != "ok") {
                $updateOK = FALSE;
                $error = $res; // for var_dump below
            } else {
                $updateOK = TRUE;
            }
        }
        
        // toggle squad visibility
        toggleSquadVisibility($day,$time,$_POST['visibility']=="on" ? 1 : 0);
    }

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
<form action="setresults.php" method="get">
<p>
    Välj start: <select name="squad">
    
<?php

    $squads = getSquadInfo();
    foreach ($squads as $squad) {
        if ($squad['cancelled']==0) {
            echo "<option value=\"$squad[day]$squad[time]\"". ($squad['day']==$day && $squad['time']==$time? " selected=\"selected\" " : "") .">". utf8_encode($squad[info]) ."</option>";
        }
    }

?>  
    </select>
    <input type="submit" value="Välj">
</p>
</form>
<?php
if (isset($day)) {
    echo "
        <form action='setresults.php' method='post'>
        <input type='hidden' name='squad' value='$day$time'>
        <p>
        OBS att resultat ska anges UTAN hcp nedan.
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
                1
            </th>
            <th>
                2
            </th>
            <th>
                3
            </th>
            <th>
                4
            </th>
            <th>
                5
            </th>
            <th>
                6
            </th>
            <th>
                Chansen
            </th>
            <th>
                Totalt
            </th>
        </tr>";
    
    $results = getSquadResultsRaw($day,$time);
  // sort results
    uasort($results, function($post1,$post2) {return ($post1['firstname'].$post1['lastname'])>($post2['firstname'].$post2['lastname']) ? 1 : -1;});
    foreach ($results as $result) {
        $reentrystring = $result['squadnumber'] == 2 ? "(R)" : ($result['squadnumber']==3 ? "(Rx2)" : "");
        echo "
        <tr>
            <td>
                $result[firstname] $result[lastname] $reentrystring
            </td>
            <td>
                $result[club]
            </td>
            <td>
                $result[hcp]
            </td>
            <td>
                <input type=\"text\" size=\"1\" value=\"$result[s1]\" name=\"s1_$result[id]\">
            </td>
            <td>
                <input type=\"text\" size=\"1\" value=\"$result[s2]\" name=\"s2_$result[id]\">
            </td>
            <td>
                <input type=\"text\" size=\"1\" value=\"$result[s3]\" name=\"s3_$result[id]\">
            </td>
            <td>
                <input type=\"text\" size=\"1\" value=\"$result[s4]\" name=\"s4_$result[id]\">
            </td>
            <td>
                <input type=\"text\" size=\"1\" value=\"$result[s5]\" name=\"s5_$result[id]\">
            </td>
            <td>
                <input type=\"text\" size=\"1\" value=\"$result[s6]\" name=\"s6_$result[id]\">
            </td>
            <td>
                <input type='checkbox' name='chansen_$result[id]' ". ($result['chansenbool'] ? " checked='checked' " : "") .">
            </td>
            <td>
                
            </td>
        </tr>";
    }

    $visible = squadIsVisible($day,$time);
    echo "</table>
    <input type='checkbox' name='visibility' ". ($visible==1 ? " checked='checked' " : "") .">Visa start i resultatlistor<br/>
    <input type='submit' value='Spara'>";
    if (isset($updateOK)) {
        echo "<br/>";
        if ($updateOK) {
            echo "<span style='color:rgb(255,0,0)'>Ok, uppdaterat " . getSETime()->format("y-m-d H:i:s") . ".</span>";
        } else {
            echo "Något fel inträffade: ";
            var_dump($error);
        }
    }
    echo "</p></form>";
}
?>
</body>
</html>
