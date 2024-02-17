<?php
require_once '../inc/connection.php';


if(isset($_GET['productId']) && isset($_SESSION['customer_id'])) {
    $productId = $_GET['productId'];
    $customer_id = $_SESSION['customer_id'];

    $query = "SELECT `orderNumber` FROM `orders` WHERE `customerNumber`= '$customer_id' AND `status` = 'in the cart'";
    $runQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($runQuery) == 0) {  // add new order 

        $query = "INSERT INTO `orders` (`orderDate`, `requiredDate`, `shippedDate`, `status`, `comments`, `customerNumber`) 
        VALUES(NOW(), DATE_ADD(NOW(), INTERVAL 10 DAY), DATE_ADD(NOW(), INTERVAL 9 DAY), 'in the cart', NULL, '$customer_id')";
        $runQuery = mysqli_query($conn, $query);
    }
    // here

    if(! empty($_POST['quantity'])) {
        $quantity = abs($_POST['quantity']);
        header("location: addItem.php?productId=$productId&quantity=$quantity");
    } else {
        header("location: addItem.php?productId=$productId");
    }


} else {
    header("location: ../login.php");
}
