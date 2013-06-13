<?php

    require_once('db/dbfuncs.php');
    $squads = getPlayerSquads($_GET['id']);
    $i=0;
    foreach ($squads as $squad) {
        echo (++$i) . "::" . $squad['day'] . $squad['time'];
    }

?>
