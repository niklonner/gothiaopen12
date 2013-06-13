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
		    <p><a href="resultat.php">Tillbaka</a></p>
		    <h2>Chansen-resultat</h2>
		    <p>Topp tre vinner presentkorgar med godis.</p>
			<?php 
			  require 'db/dbfuncs.php';
			  
      		  $results = getChansenResults();
  			  
            echo "<table class=\"result_table\">
  			    <tr>
  			        <th>
                        Pos  			        
  			        </th>
  			        <th>
  			            Spelare
  			        </th>
  			        <th>
  			            Klubb
  			        </th>
  			        <th>
  			            4
  			        </th>
  			        <th>
  			            6
  			        </th>
                    <th>
  			            Hcp
  			        </th>
  			        <th>
  			            Chansen
  			        </th>
  			    </tr>";
                $i = 1;
  			  foreach ($results as $result) {
  			    $colorstring = "";
  			    if ($i==1) {
//  			        $colorstring = "style=\"background-color:rgb(25,150,100)\""; would override hover property...
                    $colorstring = "bgcolor=\"#199664\"";
  			    } else if ($i==2) {
//  			        $colorstring = "style=\"background-color:rgb(20,125,75)\"";
  			        $colorstring = "bgcolor=\"#147D4f\"";
  			    } else if ($i==3) {
//  			        $colorstring = "style=\"background-color:rgb(15,100,50)\"";
  			        $colorstring = "bgcolor=\"#0F6432\"";
  			    } else if ($i%2!=0) {
  			        $colorstring = "class=\"alternate_result_row\"";
  			    }
            echo 
  			    "<tr $colorstring>
  			        <td>
                        $i
  			        </td>
  			        <td>
  			            $result[firstname] $result[lastname]
  			        </td>
  			        <td>
  			            $result[club]
  			        </td>
  			        <td>
  			            $result[s4]
  			        </td>
  			        <td>
  			            $result[s6]
  			        </td>
  			        <td>
  			            $result[hcp]
  			        </td>
  			        <td>
  			            $result[chansen]
  			        </td>
  			    </tr>";
  			    $i++;
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
