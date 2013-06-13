<?php
    session_start();
    require('verify_loggedin.php');
    defaultCheckLoggedIn();
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
    <a href="logout.php">Logga ut</a> <br/>
    <a href="hcp.php">Sätt spelares hcp</a> <br/>
    <a href="getsquadinfo.php">Hämta detaljer om start</a><br/>
    <a href="setresults.php">Rapportera resultat</a>
</p>
</body>
</html>
