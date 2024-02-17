<?php

session_start();

if(isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if($lang == "ar") {
        $_SESSION['lang'] = "ar";
    } elseif($lang == "en") {
        $_SESSION['lang'] = "en";
    }
    header("location: " . $_SERVER['HTTP_REFERER']);
}