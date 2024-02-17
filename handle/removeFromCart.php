<?php

require_once "../inc/connection.php";

if(isset($_SESSION['customer_id']) && isset($_POST['Remove'])) {

    $quantityproduct = $_POST['quantityproduct'];
    $orderNumber = $_POST['orderNumber'];
    $productCode = $_POST['productCode'];

    $newQuantityProduct = $quantityproduct - 1;
    if($newQuantityProduct >= 1) {
        $query = "UPDATE `orderdetails` SET `quantityproduct` = $newQuantityProduct WHERE orderNumber = '$orderNumber' AND productCode = '$productCode' ";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            header("location: ../cart.php#cart");
        }
    } else {
        $query = "DELETE FROM `orderdetails` WHERE orderNumber = '$orderNumber' AND productCode = '$productCode' ";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            header("location: ../cart.php");
        }
    }


} else {
    header("location: ../index.php");
}
