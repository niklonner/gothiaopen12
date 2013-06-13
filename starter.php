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
			<li class="current_page_item"><a href="#">Starter</a></li>
			<li><a href="kontakt.php">Kontakt</a></li>
			<li class="speciallink"><a href="http://www.teamgothiabc.se">teamgothiabc.se</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div class="post">
			<h2 class="title">Starter</h2>
			<p>
			  Nedan listas de starttillfällen som finns. För extra start, kontakta hallen (031-221517). (Klicka för att se vilka som spelar i respektive start.)
			</p>
			<p>
			<?php
			  require_once 'db/dbfuncs.php';
			?>
			    <a href="showplayers.php">Visa alla spelare (<?php echo getPlayerCount() . " spelare, " . getReentryCount() . " reentries"; ?>)</a>
			</p>
			<table>

			<?php 
			  
			  $squads = getSquadInfo();
			  foreach ($squads as $inner) {
			    if ($inner['cancelled'] == 1) {
			        echo "<tr><td style=\"padding-right:20px\">" . utf8_encode($inner[info]) . " (STRUKEN)</td><td style=\"text-align:right\">($inner[count]/$inner[spots] anmälda)</td></tr>";
			    } else {
    			    echo "<tr><td style=\"padding-right:20px\"><a href=\"showsquad.php?day=$inner[day]&time=$inner[time]\">" . utf8_encode($inner[info]) . "</a></td><td style=\"text-align:right\">($inner[count]/$inner[spots] anmälda)</td></tr>";
    			}
			  }
			?>
			</table>
		</div>
	</div>
	<div id="footer">
	<p>2012 teamgothiabc.se.</p>
	</div>
	<!-- end #footer --> 
</div>
</body>
</html>
