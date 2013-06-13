<?php

    if (isset($_POST['message'])) { // user have submitted a message
        // check required fields (simple check: fields should not be empty)
        $name = $_POST['name'];
        $phonenumber = $_POST['phonenumber'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        if (trim($name)=="" || trim($phonenumber)=="" || trim($message)=="") {
            $error['missing'] = true;
        }
        // validate captcha
        require_once('globals.php');
        require_once('recaptchalib.php');
        $resp = recaptcha_check_answer ($globCaptchaPrivKey,
                                    $_SERVER["REMOTE_ADDR"],
                                    $_POST["recaptcha_challenge_field"],
                                    $_POST["recaptcha_response_field"]);
        if (!$resp->is_valid) {
            $error['captcha'] = true;
        }
        
        if (!isset($error)) { // everything OK, lets go
            $mailmessage = $name . "\r\n" . $phonenumber . "\r\n" . $email . "\r\n" . $message;
            $ok = mail($globMailReceivers, $globMailTag . "New message",$mailmessage, $globMailHeader);
            if (!ok) {
                $error['internal'] = true;
            } else {
                header('Location: mailsent.php');
                die();
            }
        }
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gothia Open 2012</title>
<!--<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />-->
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript">
var firstClick= <?php echo isset($_POST['message']) ? "false" : "true" ?>;
function empty_message() {
    if (firstClick) {
        document.getElementById("message").value="";
        firstClick=false;
    }
}
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
			<li><a href="anmalan.php">Anmälan</a></li>
			<li><a href="starter.php">Starter</a></li>
			<li class="current_page_item"><a href="#">Kontakt</a></li>
			<li class="speciallink"><a href="http://www.teamgothiabc.se">teamgothiabc.se</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div class="post">
			<h2 class="title">Kontakt</h2>
			<h3 style="color:rgb(255,0,0)">OBS - fungerar ej (gratisservern har inga mailmöjligheter).</h3>
			<?php
			    if (isset($error['internal'])) {
			        echo "<p style=\"font-weight:bold;color:rgb(255,0,0)\">Ett internt fel uppstod. Försök igen, om det fortfarande inte fungerar får ni kontakta hallen eller maila niklas_lonnerfors@yahoo.se</p>";
			    }
			?>
			<p>
			  Fyll i formuläret nedan så svarar vi så fort vi kan. Alternativt kan ni ringa tävlingsledningen på 0761-608725.
			</p>
			<form method="post" action="kontakt.php">
			<p>
			<table>
			<tr>
			    <td>Namn:</td>
			    <td style="text-align:right"><input type="text" maxlength="40" name="name" <?php if (isset($_POST['name'])) echo "value=\"$_POST[name]\"" ?>></td>
			</tr>
            <tr>
			    <td>Telefon:</td>
			    <td style="text-align:right"><input type="text" maxlength="15" name="phonenumber" <?php if (isset($_POST['phonenumber'])) echo "value=\"$_POST[phonenumber]\"" ?>></td>
			</tr>
			<tr>
			    <td>E-mail (ej obligatoriskt):</td>
			    <td style="text-align:right"><input type="text" maxlength="40" name="email" <?php if (isset($_POST['email'])) echo "value=\"$_POST[email]\"" ?>></td>
		    </tr>
            <tr>
			    <td colspan="2">
			        <textarea name="message" id="message" rows=10 cols=60 onFocus="javascript:empty_message()"><?php if (isset($_POST['message'])) echo $_POST['message']; else echo "Skriv ditt meddelande här..." ?></textarea>
			    </td>
			</tr>
			</table>
			Ange även orden nedan: <span class="error" style="visibility:<?php echo (isset($error['captcha']) ? "visible" :"hidden") ?>">Orden du angav stämde inte.</span>
			<br/><br/>
			<?php
			    require_once('globals.php');
			    require_once('recaptchalib.php');
			    echo recaptcha_get_html($globCaptchaPublKey);
			?>
			<br/>
			<input type="submit" value="Skicka"> <span class="error" style="visibility:<?php echo (isset($error['missing']) ? "visible" :"hidden") ?>">Något fält ovan är tomt - endast e-mail-fältet får lämnas tomt.</span>
			</p>
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
