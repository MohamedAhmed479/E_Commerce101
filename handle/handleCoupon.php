<?php
require_once "../inc/connection.php";
require_once "checkAvalibleCoupons.php";

if(isset($_POST['coupon-code']) && isset($_POST['submit'])) {
    $coupon = $_POST['coupon-code'];
    $totalPriceProducts = $_POST['totalPriceProducts'];


    $query = "SELECT `Coupon`, `idDiscount` FROM coupons WHERE `Coupon` = '$coupon' AND `status` = 'available'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) > 0) {
        $idDiscount = mysqli_fetch_assoc($runQuery)['idDiscount'];
        // يعني موجود

        $query = "SELECT `amount`, `minimumAmount`, `maximumDiscount` FROM discounts WHERE `id` = '$idDiscount' AND `status` = 'available'";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery) > 0) {
            $DISCOUNT = mysqli_fetch_assoc($runQuery);
            $discountPercentage = $DISCOUNT['amount'];
            $minimumTotalPrice = $DISCOUNT['minimumAmount'];
            $maximumDiscount = $DISCOUNT['maximumDiscount'];

            if($minimumTotalPrice <= $totalPriceProducts) {
                $DescAmount = $totalPriceProducts * $discountPercentage / 100;
                if($DescAmount > $maximumDiscount) {
                    $DescAmount = $maximumDiscount;
                    $totalPriceProductsAfterDesc = $totalPriceProducts - $DescAmount;
                } else {
                    $totalPriceProductsAfterDesc = $totalPriceProducts - $DescAmount;
                }
                $_SESSION['totalPriceProductsAfterDesc'] = $totalPriceProductsAfterDesc;
                $_SESSION['coupon'] = $coupon;
                header("location: ../cart.php");

            } else {
                $theDifference = $minimumTotalPrice - $totalPriceProducts;
                $msg = "in order to benefit from the discount, <br>your purchasees must exceed $$theDifference";
                $_SESSION['msg'] = $msg;
                header("location: ../cart.php");
                
            }


        }


    } else {
        $msg = "The coupon is invalid";
        $_SESSION['msg'] = $msg;
        header("location: ../cart.php");
    }
} else {
    header("location: ../cart.php");
}