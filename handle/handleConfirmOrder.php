<?php
require_once "../inc/function.php";
require_once "../inc/connection.php";
?>



<?php
if(isset($_POST['submit']) && isset($_POST['orderNumber'])) {
    $orderNumber = $_POST['orderNumber'];
    $query = "UPDATE `orders` SET `status` = 'Under implement' WHERE `orderNumber` = '$orderNumber' AND `status` = 'in the cart'";
    $runQuery = mysqli_query($conn, $query);
}

?>



<?php

// =======================


if(isset($_POST['totalPriceOrder']) && isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $city = htmlspecialchars(trim($_POST['city']));
    $postalCode = htmlspecialchars(trim($_POST['postalCode']));
    $totalPriceOrder = $_POST['totalPriceOrder'];

    // validation 
    $errors = [];
    if(empty($city)) {
        $errors[] = "City is require";
    }

    if(empty($postalCode)) {
        $errors[] = "postalCode is require";
    } elseif (! is_string($postalCode)) {
        $errors[] = "postalCode must be numbers";
    } elseif (($postalCode) < 0) {
        $errors[] = "postalCode Not Correct";
    }

    if(empty($errors)) {
        $query = "SELECT  `requiredDate` FROM `orders` WHERE `customerNumber` = '$customer_id' AND `orderNumber` = '$orderNumber'";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery) == 1) {
            $order = mysqli_fetch_assoc($runQuery);
            $payday = $order['requiredDate'];
        }
        echo $orderNumber;
        echo "<br>";
        echo $customer_id;

        $checkNumber = generateRandomString();
        $query = "INSERT INTO `payments`(`idCustomer`,`orderNumber`,`checkNumber`,`payday`, `amount`, `city`, `postalCode`)
                            VALUES('$customer_id', '$orderNumber', '$checkNumber', '$payday', '$totalPriceOrder', '$city', '$postalCode')";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) { 
                $_SESSION['checkNumber'] = $checkNumber; 
                $_SESSION['totalPriceOrder'] = $totalPriceOrder; 
                header("location: ../PaymentDetails.php");
                

        }

    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['orderNumber'] = $orderNumber;
        $_SESSION['totalPriceOrder'] = $totalPriceOrder;
        header("location: ../confirmOrder.php");
    }


}