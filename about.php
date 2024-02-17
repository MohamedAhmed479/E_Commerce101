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
<html>
<head>
    <title><?php echo $msglang['About Haga Helwa - Clothing Trade'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            padding: 20px;
            background-color: plum;
        }
        .content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            margin-bottom: 10px;
        }
        .section p {
            line-height: 1.5;
        }

        h1, h2, h3 {
            color: paleturquoise; 
        }
        p {
            color: purple;
        }
        
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo $msglang['About Haga Helwa - Clothing Trade'] ?></h1>
    </div>
    <div class="content">
        <div class="section">
            <h2><?php echo $msglang['Our Mission'] ?></h2>
            <p><?php echo $msglang['At Haga Helwa,'] ?></p>
        </div>
        <div class="section">
            <h2><?php echo $msglang['Our History'] ?></h2>
            <p><?php echo $msglang['Haga Helwa was founded in 2010'] ?></p>
        </div>
        <div class="section">
            <h2><?php echo $msglang['Our Team'] ?></h2>
            <p><?php echo $msglang['Our team is made up of'] ?></p>
        </div>
        <div class="section">
            <h2><?php echo $msglang['Our Values'] ?></h2>
            <p><?php echo $msglang['At Haga Helwa, we believe'] ?></p>
        </div>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>
