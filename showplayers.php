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
		    <p>
		        <a href="starter.php">Tillbaka</a>
		    </p>
			<h2 class="title">Alla spelare</h2>
            <?php 
                require_once 'db/dbfuncs.php';
                
                $players = getAllPlayersWithSquads();
                
                echo "<table><tr><th style=\"text-align:left\">Spelare</th><th style=\"text-align:left\">Klubb</th><th style=\"text-align:left\">Start</th></tr>";
                $prev = array();
                foreach ($players as $player) {
                    $info = utf8_encode($player['info']);
                    if ($player['firstname']==$prev['firstname'] 
                        && $player['lastname']==$prev['lastname'] 
                        && $player['club']==$prev['club']) {
                    echo <<<EOT
<tr>
    <td style="padding-right:20px">
        &nbsp;
    </td>
    <td style="padding-right:20px">
        &nbsp;
    </td>
    <td>
        $info (R)
    </td>
</tr>
EOT;
                    } else {
                    echo <<<EOT
<tr>
    <td style="padding-right:20px">
        $player[firstname] $player[lastname]
    </td>
    <td style="padding-right:20px">
        $player[club]
    </td>
    <td>
        $info
    </td>
</tr>
EOT;
                    }
                    $prev = $player;
                }
                
                echo "</table>";
            
            ?>
		</div>
	</div>
	<div id="footer">
	<p>2012 teamgothiabc.se.</p>
	</div>
	<!-- end #footer --> 
</div>
</body>
</html>
