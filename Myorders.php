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
<html lang="<?php echo $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Order list </title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        #orders-list {
            padding: 20px;
        }

        /* تنسيق القائمة */
        .order {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }

        .order h2 {
            color: #333;
        }

        .order p {
            margin: 0;
        }

        .center-button {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Optional: adjust as needed for your design */
        }

        /* Style the button */
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




<?php
require_once "inc/connection.php";
    if(isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];
        $query = "SELECT `orderNumber`,`shippedDate`, `requiredDate` FROM `orders` WHERE `customerNumber` = '$customer_id' AND `status` = 'Under implement' ";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery) > 0) {
            $orders = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
        } else {
            null;
        }
    }


?>


</head>
<body>

    <header>
        <h1> <?php echo $msglang["Order list"] ?> </h1>
    </header>

    <?php if(! empty($orders)) :
            foreach ($orders as $order) : ?>
    <section id="orders-list">
        <div class="order">
            <h2> <?php echo $msglang["Order Number"] ?> : <?php echo $order['orderNumber'] ?> </h2>
            <p> <?php echo $msglang["Shipping Date"] ?> : <?php echo $order['shippedDate'] ?> </p>
            <p> <?php echo $msglang["Delivery Date"] ?> : <?php echo $order['requiredDate'] ?> </p>
        </div>
    </section>
            <?php endforeach; ?>
    
        <?php else :
                echo "Sorry, But You Don't Have Any Order Now!";
        endif; ?>

        <form action="index.php" method="post" class="center-button">
            <button type="submit"><?php echo $msglang["Back to Home"] ?></button>
        </form>

</body>
</html>
