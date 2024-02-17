<?php
include "header.php";
include "navbar.php";
require_once "inc/connection.php";
?>

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



<?php
if(isset($_SESSION['checkNumber']) && isset($_SESSION['totalPriceOrder'])) {
    $checkNumber = $_SESSION['checkNumber'];
    $totalPriceOrder = $_SESSION['totalPriceOrder'];
    
    $query ="SELECT `payday` FROM `payments` WHERE checkNumber = '$checkNumber'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $payday = mysqli_fetch_assoc($runQuery)['payday'];
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Payment details </title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            background-color: #3498db;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .order-details {
            margin-top: 20px;
        }

        p {
            color: #555;
            margin: 10px 0;
        }

        strong {
            color: #333;
        }

        form {
        display: inline; /* Display the form inline to keep it in the same line as other content */
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>


</head>
<!-- Your existing HTML code -->

<body>
    <div class="confirmation-container">
        <h1> <?php echo $msglang["Order received successfully!"] ?></h1>
        
        <div class="order-details">
            <p> <?php echo $msglang["Payment transaction number:"] ?><strong><?php echo $checkNumber ?></strong></p>
            <p> <?php echo $msglang["Order arrival time:"] ?> <strong><?php echo $payday ?></strong></p>
            <p> <?php echo $msglang["The total price required to be paid is:"] ?> <strong>$<?php echo $totalPriceOrder ?></strong></p>
            <p><?php echo $msglang["Paiement when receiving"] ?></p>
        </div>

        <!-- Use the styled form and button for the Back to Home link -->
        <form action="index.php" method="post">
            <button type="submit"><?php echo $msglang["Back to Home"] ?></button>
        </form>
    </div>
</body>

</html>




<?php include "footer.php" ?>
