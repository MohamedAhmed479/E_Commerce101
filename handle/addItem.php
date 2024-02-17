<?php
require_once '../inc/connection.php';

if(isset($_SESSION['customer_id']) && isset($_GET['productId'])) {
    $customer_id = $_SESSION['customer_id'];
    $productCode = $_GET['productId'];

    if(isset($_GET['quantity'])) {
        $quantity = $_GET['quantity'];
    } else {
        $quantity = 1;
    }

    // محتاج ال orderNumber 
    $query = "SELECT `orderNumber` FROM `orders` WHERE `customerNumber`= '$customer_id' AND `status` = 'in the cart'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $orderNumber = mysqli_fetch_assoc($runQuery)['orderNumber'];
    }


    // عاوز اجيب سعر المنتج واجيب العدد المتاح
    $query = "SELECT `quantityInStock`, `buyPrice` FROM `products` WHERE `productCode` = '$productCode'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $product = mysqli_fetch_assoc($runQuery);
        $quantityproduct = $product['quantityInStock'];
        $priceproduct = $product['buyPrice'];
    }


    if($quantityproduct >= $quantity) {

        // هشوف هل المنتج دا موجود قبل كدا ولا لا ولو موجود هزود بس العدد المطلوب والسعر 
        $query = "SELECT `quantityproduct` FROM `orderdetails` WHERE `productCode` = '$productCode' AND `orderNumber` = '$orderNumber'";
        $runQuery = mysqli_query($conn, $query);
        $productInCart = mysqli_fetch_assoc($runQuery); 

        if(mysqli_num_rows($runQuery) == 1) {
            $quantityProductInCart = $productInCart['quantityproduct']; 

            // هنا انا بس محتاج اني هزود بس عدد المطلوب والسعر اعدله علشان لو السعر كان اتغير 
            $NewQuantityProductInCart = $quantityProductInCart + $quantity; 

            $query = "UPDATE `orderdetails` SET `quantityproduct` = $NewQuantityProductInCart, priceEach = $priceproduct WHERE `productCode` = '$productCode' AND `orderNumber` = '$orderNumber'";
            $runQuery = mysqli_query($conn, $query);
            if($runQuery) {
                $_SESSION['success'] = "Added Successfully";
                header("location: ../cart.php");

            }

        } else {
            // يبقا المنتج مكنش موجود قبل كدا فهضيف من جديد
            $NewQuantityProductInCart = $quantity;
            $query = "INSERT INTO `orderdetails` (`orderNumber`, `productCode`, `quantityproduct`,  `priceEach`) 
            VALUES('$orderNumber', '$productCode', '$NewQuantityProductInCart', '$priceproduct')";
            $runQuery = mysqli_query($conn, $query);

            if($runQuery) {
                $_SESSION['success'] = "Added Successfully";
                header("location: ../cart.php");

            }
        }

    } else {
        $_SESSION['errors'] = ["The required quantity is currently not available"];
        header("location: ../index.php");
    }

} else {
    header("location: ../login.php");
}
