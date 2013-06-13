<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gothia Open 2012</title>
<!--<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />-->
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
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
			<li><a href="anmalan.php">Anmälan</a></li>
			<li class="current_page_item"><a href="starter.php">Starter</a></li>
			<li><a href="kontakt.php">Kontakt</a></li>
			<li class="speciallink"><a href="http://www.teamgothiabc.se">teamgothiabc.se</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div class="post">
		    <p><a href="starter.php">Tillbaka</a></p>
			<?php 
			  require 'db/dbfuncs.php';
			  
  			  echo "<h2 class=\"title\">" . utf8_encode(getSquadInfoLine($_GET['day'], $_GET['time'])) . "</h2>";

              echo "<ul class=\"squads\">";
			  
			  $players = getSquadPlayers($_GET['day'], $_GET['time']);
			  if (count($players) > 0) {
  			      $i=1;
			      echo '<table><tr><th>&nbsp;</th><th style="text-align:left">Spelare</th><th style="text-align:left">Klubb</th></tr>';
			      foreach ($players as $player) {
			        echo "<tr><td style=\"padding-right:5px\">$i.</td><td style=\"padding-right:50px\">$player[firstname] $player[lastname] ". ($player['squadnumber']==2 ? "(R)" : ($player['squadnumber']==3? "(Rx2)" : "") ) ."</td><td>$player[club]</td></tr>";
			        $i++;
			      }
			      echo '</table>';
			  } else {
			    echo 'Inga startande.';
			  }
			?>
			</ul>
		</div>
	</div>
	<div id="footer">
	<p>2012 teamgothiabc.se.</p>
	</div>
	<!-- end #footer --> 
</div>
</body>
</html>
