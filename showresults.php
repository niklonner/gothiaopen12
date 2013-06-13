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
			<?php 
			  require 'db/dbfuncs.php';
			  
  			  if (isset($_GET['day']) && isset($_GET['time'])) {
    			  echo "<h2 class=\"title\">" . utf8_encode(getSquadInfoLine($_GET['day'], $_GET['time'])) . "</h2>";
      			  $results = getSquadResults($_GET['day'],$_GET['time']);
      	      } else {
      	        echo "<h2>Alla resultat</h2>";
      	        $results = getAllResults();      	         
      	        $allresults = true;
      	        $prizes = getAllPrizesInfo();
      	      }
      	      if ($results[0]['s6'] == 0) {
      	          $results = onlyDoneResults($results);
      	      }
  			  
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
  			        <th class=\"game\">
  			            1
  			        </th>
  			        <th class=\"game\">
  			            2
  			        </th>
  			        <th class=\"game\">
  			            3
  			        </th>
  			        <th class=\"game\">
  			            4
  			        </th>
  			        <th class=\"game\">
  			            5
  			        </th>
  			        <th class=\"game\">
  			            6
  			        </th>
  			        <th>
  			            Scratch
  			        </th>
  			        <th>
  			            Hcp
  			        </th>
  			        <th>
  			            Ch.
  			        </th>
  			        <th>
  			            Totalt
  			        </th>".
  			        (isset($allresults) ? "<th><a href=\"prizes.php\">Prissumma</a></th>" : "")
  			        ."
  			    </tr>";
                $i = 1;
  			  foreach ($results as $result) {
  			      			  $chansen = $result['chansen']==0 ? "&nbsp;" : $result['chansen'];
            echo 
  			    "<tr ". ($i%2 != 0 ? "class=\"alternate_result_row\"" : "").">
  			        <td>
                        $i
  			        </td>
  			        <td>
  			            $result[firstname] $result[lastname] " . ($result['squadnumber']==1 ? "" : ($result['squadnumber']==2 ? "(R)" : "(Rx2)")) . "
  			        </td>
  			        <td>
  			            $result[club]
  			        </td>
  			        <td class=\"game\">
  			            $result[s1]
  			        </td>
  			        <td class=\"game\">
  			            $result[s2]
  			        </td>
  			        <td class=\"game\">
  			            $result[s3]
  			        </td>
  			        <td class=\"game\">
  			            $result[s4]
  			        </td>
  			        <td class=\"game\">
  			            $result[s5]
  			        </td>
  			        <td class=\"game\">
  			            $result[s6]
  			        </td>
  			        <td>
  			            $result[scratch]
  			        </td>
  			        <td>
  			            $result[hcp]
  			        </td>
  			        <td>
  			            $chansen
  			        </td>
  			        <td>
  			            $result[total]
  			        </td>".
  			        (isset($allresults) ? "<td style=\"text-align:center\">".(isset($prizes['prizes'][$i-1]) ? ($prizes['prizes'][$i-1] < 0 ? "Fri start 2013" : $prizes['prizes'][$i-1] . " kr") : "")."</td>" : "")
  			        ."
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
