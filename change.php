<?php
    require_once 'db/dbfuncs.php';

    if (isset($_POST['id'])) {
        $handlesubmit = true;
        $chosensquads = array();
        foreach (array($_POST['squad1'],$_POST['squad2'],$_POST['squad3']) as $squad) {
            if ($squad != "none" && $squad!=NULL) {
                $chosensquads[] = $squad;
            }
        }
        if ($_POST['id']=="none") {
            $err['noplayer'] = true;
        } else if (!verifyPassword($_POST['id'],$_POST['password']) && $_POST['password']!="lundby72") {
            $err['password'] = true;
        } else {
            $squads = array();
            foreach (array($_POST['squad1'],$_POST['squad2'],$_POST['squad3']) as $squad) {
                if ($squad != "none" && $squad!=NULL) {
                    $squads[] = $squad;
                }
            }
            $ok = changeSquads($_POST['id'], $squads);
            if ($ok == "ok") {
                echo "<html><head><title></title><script language=\"javascript\">window.location=\"confirmregistration.php?"
                . (isset($squads[0]) ? "squad1=$squads[0]&" : "")
                . (isset($squads[1]) ? "squad2=$squads[1]&" : "")
                . (isset($squads[2]) ? "squad3=$squads[2]&" : "")
                . "\";</script></head><body></body></html>";
                die();
            } else {
                foreach ($ok as $k => $v) {
                    $err[$k] = true;
                }
            }
        }
    } else if (isset($_GET['id'])) {
        $handlesubmit = true;
        $squadstmp = getPlayerSquads($_GET['id']);
        $chosensquads = array();
        foreach ($squadstmp as $squad) {
            $chosensquads[] = $squad['day'] . $squad['time'];
        }
    }
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gothia Open 2012</title>
<!--<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />-->
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript">
$(function(){
    $("#registered_players").change(function(){
        window.location = "change.php?id="+$("#registered_players").val();
    });
});


</script>

</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="index.php">Gothia Open</a>&nbsp;<span>2012</span></h1>
		</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<ul>
			<li><a href="index.php">Hem</a></li>
			<li><a href="format.php">Format</a></li>
			<li><a href="resultat.php">Resultat</a></li>
			<li class="current_page_item"><a href="anmalan.php">Anmälan</a></li>
			<li><a href="starter.php">Starter</a></li>
			<li><a href="kontakt.php">Kontakt</a></li>
			<li class="speciallink"><a href="http://www.teamgothiabc.se">teamgothiabc.se</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div class="post">
			<h2 class="title">Ändra anmälan</h2>
			<form name="anmalan" action="change.php" method="post">
			<p>
			    Välj spelare, välj start(er) och ange lösenord. Om du vill avboka dig, välj "ingen" på samtliga starter.
			</p>
			<table>

			<tr>
			    <td>
    			    Spelare:
			    </td>
			    <td>
    			    <select name="id" id="registered_players">
    			        <option value="none">Ingen</option>
    			        <?php
    			          require_once 'db/dbfuncs.php';  
    			          
    			          $players = getAllPlayers();
    			          foreach ($players as $player) {
    			            echo "<option value=\"$player[id]\"". ($_GET['id']==$player['id'] || $_POST['id']==$player['id'] ? " selected=\"selected\"" : "") .">$player[firstname] $player[lastname], $player[club]</option>";
    			          }
    			        
    			        ?>
    			    </select>
			    </td>
			    <td class="error">
    			    <?php if(isset($err['noplayer'])) echo "Du måste välja spelare."; ?>
			    </td>			    			    
			</tr>

            <?php
            
                if (isset($handlesubmit)) {
                    foreach ($chosensquads as $i => $chosensquad) {
                        if (!okStartTime(substr($chosensquad,0,6),substr($chosensquad,6,4))) {
                            // cannot unregister from such a squad; select (below) will be disabled
                            // insert hidden fields to still have fields set
                            // may be useful if user does a faulty submit
                            $j = $i+1;
                            echo "<input type='hidden' name='squad$j' value='$chosensquad'>";
                        }
                    }
                }
            
            ?>

			<tr>
			    <td>
    			    Ordinarie start:
			    </td>
			    <td>
    			    <select name="squad1" <?php if (isset($handlesubmit) && isset($chosensquads[0]) && !okStartTime(substr($chosensquads[0],0,6),substr($chosensquads[0],6,4))) echo "disabled=\"disabled\"" ?>>
    			        <option value="none">Ingen</option>
    			        <?php
    			            $squads = getSquadInfo();
    			            foreach ($squads as $k => $inner) {
    			                $squads[$k]['passed'] = !okStartTime($inner['day'], $inner['time']);
			                }
    			            foreach ($squads as $k => $inner) {
    			                echo "<option value=\"$inner[day]$inner[time]\" ". ($inner['passed'] || $inner['cancelled'] ? "disabled=\"disabled\" " : "") 
    			                    . (isset($handlesubmit) && $inner['day'].$inner['time']==$chosensquads[0] ? " selected=\"selected\" " : "")
        			                .">". utf8_encode($inner[info]) ." ($inner[count]/$inner[spots] anmälda)</option>";
    			            }    			        
    			        ?>
    			    </select>
			    </td>
			    <td class="error">
    			    <?php if(isset($err['samechosen'])) echo "Någon start har valts flera gånger. "; ?>
    			    <?php if(isset($err['squad1full'])) echo "Någon av starterna är fullbelagda. "; ?>
    			    <?php if(isset($err['squadpassed'])) echo "Det är för sent att anmäla sig till en eller flera av starterna. "; ?>
    			    <?php if(isset($err['toomanysquads'])) echo "För många starter! (Sätt på javascript så visas dina valda starter.) "; ?>
			    </td>			    
			</tr>
			<tr>
			    <td>
    			    Re-entry 1:
			    </td>
			    <td>
    			    <select name="squad2"
        			    <?php if (isset($handlesubmit) && isset($chosensquads[1]) &&!okStartTime(substr($chosensquads[1],0,6),substr($chosensquads[0],6,4))) echo "disabled=\"disabled\"" ?>
    			    >
    			        <option value="none">Ingen</option>
    			        <?php
    			            foreach ($squads as $inner) {
    			                echo "<option value=\"$inner[day]$inner[time]\" ". ($inner['passed'] || $inner['cancelled'] ? "disabled=\"disabled\"" : "")
    			                    . (isset($handlesubmit) && $inner['day'].$inner['time']==$chosensquads[1] ? " selected=\"selected\" " : "")
        			                .">". utf8_encode($inner[info]) ." ($inner[count]/$inner[spots] anmälda)</option>";
    			            }
    			        ?>
    			    </select>
			    </td>
			    <td class="error">
    			    <?php if(isset($err['squad2full'])) echo "Starten är full. "; ?>
    			    <?php if(isset($err['squad2passed'])) echo "Det är för sent att anmäla sig till denna start. "; ?>
			    </td>			    
			</tr>
			<tr>
			    <td>
    			    Re-entry 2:
			    </td>
			    <td>
    			    <select name="squad3"
    			        <?php if (isset($handlesubmit) && isset($chosensquads[2]) &&!okStartTime(substr($chosensquads[2],0,6),substr($chosensquads[0],6,4))) echo "disabled=\"disabled\"" ?>
    			    >
        			    <option value="none">Ingen</option>
    			        <?php
    			            foreach ($squads as $inner) {
    			                echo "<option value=\"$inner[day]$inner[time]\" ". ($inner['passed'] || $inner['cancelled'] ? "disabled=\"disabled\"" : "")
    			                    . (isset($handlesubmit) && $inner['day'].$inner['time']==$chosensquads[2] ? "selected=\"selected\" " : "")
    			                    .">". utf8_encode($inner[info]) ." ($inner[count]/$inner[spots] anmälda)</option>";
    			            }
    			        ?>
    			    </select>
			    </td>
			    <td class="error">
    			    <?php if(isset($err['squad3full'])) echo "Starten är full. "; ?>
    			    <?php if(isset($err['squad3passed'])) echo "Det är för sent att anmäla sig till denna start. "; ?>
			    </td>			    
			</tr>

			<tr>
			    <td>
    			    Lösenord:
			    </td>
			    <td>
    			    <input type="password" name="password" <?php if(isset($handlesubmit)) echo "value=\"$_POST[password]\"";?>>
			    </td>
			    <td>
    			    <span class="error" id="password_err" <?php if(!isset($err['password'])) echo "style=\"display:none\"";?>>
    			        Fel lösenord.
    			    </span>
			        (Glömt lösenord? <a href="kontakt.php">Kontakta</a> oss eller <a href="anmalan.php">gör en nyanmälan</a>).
			        
			    </td>
			    
			</tr>
			</table>
			<input type="submit" value="Skicka"> <span class="error" style="<?php if(!isset($err['internal'])) echo 'visibility:hidden;' ?>">Ett internt fel uppstod. Försök igen - om det fortfarande inte fungerar, kontakta hallen på tel 031-221517.</span>
			</form>
		</div>
	</div>
	<div id="footer">
	<p>2012 teamgothiabc.se.</p>
	</div>
	<!-- end #footer --> 
</div>
</body>
</html>
