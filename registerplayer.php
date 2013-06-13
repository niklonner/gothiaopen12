<?php

require_once 'db/dbfuncs.php';

    foreach ($_POST as $k => $v)
        echo "$k: $v<br>";

    $ok = registerPlayer($_POST['firstname'], $_POST['lastname'], $_POST['club'], $_POST['phonenumber'], $_POST['email'],
        $_POST['password'], $_POST['password_repeat'], $_POST['squad1'], $_POST['squad2'], $_POST['squad3']);
    
    if ($ok != "ok") {
        header();
    }
    
    echo "res: <br>";
    
    foreach ($ok as $k => $v)
        echo "$k<br>";
?>
