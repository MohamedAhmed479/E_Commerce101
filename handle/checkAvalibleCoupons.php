<?php

require_once "../inc/connection.php";

$query = "UPDATE `coupons` INNER JOIN `discounts` ON `coupons`.`idDiscount` = `discounts`.`id` SET `coupons`.`status` = 'Not Available', `discounts`.`status` = 'Not Available' WHERE `discounts`.`endsAt` < CURDATE()";
$runQuery = mysqli_query($conn, $query);


?>
