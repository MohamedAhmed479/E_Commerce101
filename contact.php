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
            background-color: #f8f9fa;
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
        .contact-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .contact-form input[type="text"], .contact-form input[type="email"], .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .contact-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo $msglang['About Haga Helwa - Clothing Trade'] ?></h1>
    </div>
    <div class="content">
        <div class="section">
            <h2><?php echo $msglang['Get in Touch'] ?></h2>
            <p><?php echo $msglang['If you have any questions or need assistance,'] ?> <a href="mailto:info@hagahelwa.com">info@hagahelwa.com</a>.</p>
        </div>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>
