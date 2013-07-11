<?php
require_once('globals.php');

function isLoggedIn() {
    global $globSalt;
    return $_SESSION['auth'] == sha1($globSalt . $_SESSION['timestamp']);
}

function defaultCheckLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        die();
    }
}



?>
