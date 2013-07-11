<?php
require('globals.php');

function isLoggedIn() {
    return $_SESSION['auth'] == sha1("admin" . $globSalt . $_SESSION['timestamp']);
}

function defaultCheckLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        die();
    }
}



?>
