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
			<li class="current_page_item"><a href="resultat.php">Resultat</a></li>
			<li><a href="anmalan.php">Anmälan</a></li>
			<li><a href="starter.php">Starter</a></li>
			<li><a href="kontakt.php">Kontakt</a></li>
			<li class="speciallink"><a href="http://www.teamgothiabc.se">teamgothiabc.se</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div class="post">
			<h2 class="title">Prispengar</h2>
			<?php
			    require_once('db/dbfuncs.php');
			    $prizes = getAllPrizesInfo($_GET['players'],$_GET['reentries']);
			    $totalparticipation = $prizes['playercount'] + $prizes['reentrycount'];
			?>
			<p>
			    <span style="font-weight:bold">Prispotten just nu:</span> <br/>
			    Ordinarie starter <?php echo "$prizes[playercount] x $prizes[playergivesprizefund] kr = " . $prizes['playercount']*$prizes['playergivesprizefund'] . " kr" ?> <br/>
			    Re-entries <?php echo "$prizes[reentrycount] x $prizes[reentrygivesprizefund] kr = " . $prizes['reentrycount']*$prizes['reentrygivesprizefund'] . " kr"?> <br/>
			    Totalt <span style="font-weight:bold"><?php echo $prizes['prizefund'] ?></span> kr
			</p>
			<p>
			    <?php
			        if (isset($prizes['fixed'])) { // minimum prizes
			            echo "Prispotten uppgår inte till den garanterade prissumman (24.000 kr), penningpriserna blir därför de garanterade:<table><tr><th>Pos</th><th>Prissumma</th></tr>";
			            foreach ($prizes['prizes'] as $k => $prize) {
			                $j = $k+1;
			                if ($prize >= 0) {
    			                echo "<tr><td>$j</td><td style=\"text-align:center\">".round($prize)." kr</td></tr>";
    			            } else {
    			                echo "<tr><td>$j</td><td style=\"text-align:center\">Gratis start 2013</td></tr>";
    			            }
			            }
                        echo "</table>";
			        } else {
			            echo "Priserna blir som följer:<table><tr><th>Pos</th><th>Andel</th><th>Prissumma</th></tr>";
			            foreach ($prizes['prizes'] as $k => $prize) {
			                $j = $k+1;
			                if ($prize >= 0) {
    			                echo "<tr><td>$j</td><td>".$prizes['distribution'][$k]."</td><td style=\"text-align:center\">".round($prize)." kr</td></tr>";
    			            } else {
    			                echo "<tr><td>$j</td><td>-</td><td style=\"text-align:center\">Gratis start 2013</td></tr>";
    			            }
			            }
			            echo "</table>";
			        }
			    ?>
			</p>
			
		</div>
	</div>
	<div id="footer">
	<p>2012 teamgothiabc.se.</p>
	</div>
	<!-- end #footer --> 
</div>
</body>
</html>
