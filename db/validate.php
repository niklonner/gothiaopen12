<?php

//require_once 'dbfuncs.php';

function verify_lastname($string) {

    $res = preg_match("#^[\p{L}\- ]+$#u", $string);

    return (!(!$res || $res==0));

}

function verify_firstname($string) {

    $res = preg_match("#^[\p{L}\- ]+$#u", $string);

    return (!(!$res || $res==0));

}

function verify_club($string) {

    $res = preg_match("#^[\p{L}\- 0-9]+$#iu", $string);

    return (!(!$res || $res==0));

}

function verify_password($string) {

    $res = preg_match("#^[a-z0-9]{6,15}$#i", $string);

    return (!(!$res || $res==0));

}

function verify_phonenumber($string) {

    $res = preg_match("#^[0-9]{8,15}$#", $string);

    return (!(!$res || $res==0));

}

function verify_id($string) {

    $res = preg_match("#^[0-9]+$#", $string);

    return (!(!$res || $res==0));

}

function verify_email($string) {

    $res = preg_match("#^[0-9a-zA-Z\.\-\_]+@[0-9a-zA-Z\.\-\_]+$#", $string);

    return (!(!$res || $res==0));

}

function verify_start($string) {

    if (!preg_match("#^[0-9]{10}$#", $string)) {
        die("Internal error");
    }

    return squadExists(substr($string,0,6), substr($string,-4));
}

?>
