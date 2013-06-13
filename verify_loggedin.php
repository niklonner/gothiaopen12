<?php

function isLoggedIn() {
    return $_SESSION['auth']=="ok";
}

function defaultCheckLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        die();
    }
}



?>
