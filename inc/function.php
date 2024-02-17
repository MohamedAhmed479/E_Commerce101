<?php

function check($page, $numberOfPages) {
    if($page > $numberOfPages ){
        return false;
    } else {
        return  true;
    }
}



function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = 'HQ_';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}



