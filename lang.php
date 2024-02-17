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
?>

<!DOCTYPE html>
<html lang="<?php echo $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Document </title>
</head>
<body>
    
</body>
</html>

