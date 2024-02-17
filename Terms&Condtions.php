<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php
if(isset($_SESSION['lang'])) {
  $lang = $_SESSION['lang'];
} else {
  $lang = "en";
}
if($lang == "ar") {
    require_once "arabic.php";
  } else {
    require_once "english.php";
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $msglang['Terms & Conditions - Haga Helwa'] ?></title>
</head>
<body>
<h1><?php echo $msglang['Haga Helwa - Terms & Conditions'] ?></h1>
<p><?php echo $msglang['Welcome to our website.'] ?></p>
<p><?php echo $msglang['Please read these terms'] ?></p>
<h3><?php echo $msglang['1. Introduction'] ?></h3>
<p><?php echo $msglang['These terms and conditions apply between you,'] ?></p>
<h3><?php echo $msglang['2. Intellectual property and acceptable use'] ?></h3>
<p><?php echo $msglang['All Content included on the Website,'] ?></p>
<p><?php echo $msglang['By using the Website, you agree that:'] ?></p>
<ul>
<li><?php echo $msglang['You will not use the Website for any unlawful purpose.'] ?></li>
<li><?php echo $msglang['You will not use the Website to harm,'] ?></li>
<li><?php echo $msglang['You will not copy, reproduce,'] ?></li>
</ul>
<h3><?php echo $msglang['3. Limitation of liability'] ?></h3>
<p><?php echo $msglang['Haga Helwa will not be liable'] ?></p>
<h3><?php echo $msglang['4. Governing jurisdiction'] ?></h3>
<p><?php echo $msglang['These terms and conditions shall'] ?></p>
<h3><?php echo $msglang['5. Changes to these terms and conditions'] ?></h3>
<p><?php echo $msglang['Haga Helwa reserves the right to'] ?></p>
<h3><?php echo $msglang['6. Contact us'] ?></h3>
<p><?php echo $msglang['If you have any questions'] ?></p>
</body>
</html>

<?php include 'footer.php'; ?>
