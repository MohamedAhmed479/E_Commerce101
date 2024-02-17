<?php
require_once "../inc/connection.php";

if(isset($_POST['removeAll']) && isset($_POST['orderNumber'])) {
    $orderNumber = $_POST['orderNumber'];

    $query = "DELETE FROM `orderdetails` WHERE `orderNumber` = '$orderNumber' ";
    $runQuery = mysqli_query($conn, $query);
    if($runQuery) {
        $_SESSION['success'] = "All products have been removed from the shopping cart";
        header("location: ../index.php");
    }

} else {
    header("location: ../cart.php");
}