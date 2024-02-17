<?php
include "header.php";
include "navbar.php";
require_once "inc/connection.php";


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





if(! isset($_SESSION['customer_id'])) {
    header("location: login.php");
}


if(isset($_POST['orderNumber']) && isset($_POST['totalPriceOrder'])) {
    $totalPriceOrder = $_POST['totalPriceOrder'];
    $orderNumber = $_POST['orderNumber'];
} elseif(isset($_SESSION['orderNumber']) && isset($_SESSION['totalPriceOrder'])) {
    $totalPriceOrder = $_SESSION['totalPriceOrder'];
    $orderNumber = $_SESSION['orderNumber'];
    unset($_SESSION['totalPriceOrder']);
    unset($_SESSION['orderNumber']);
}





$customer_id = $_SESSION['customer_id'];
$query = "SELECT `username`, `email`, `customeraddres`, `phone` FROM `customers` WHERE `idcustomer` = '$customer_id' ";
$runQuery = mysqli_query($conn, $query);
if(mysqli_num_rows($runQuery) == 1) {
    $customer = mysqli_fetch_assoc($runQuery);
    $name = $customer['username'];
    $email = $customer['email'];
    $address = $customer['customeraddres'];
    $phone = $customer['phone'];
}

require_once "inc/errors.php";

?>



<section id="cart-add" class="section-p1">
    <form >
        </form>
        <div id="subTotal">
            <h3><?php echo $msglang["Cart totals"] ?></h3>
            <form class=" col-4" action="handle/handleConfirmOrder.php" method="post">
                <?php echo $msglang["Name"] ?><input type="text" value="<?php if(isset($name)) echo $name ?>" readonly>
                <?php echo $msglang["email"] ?><input type="email" value="<?php if(isset($email)) echo $email ?>" readonly>
                <?php echo $msglang["address"] ?><input type="text" value="<?php if(isset($address)) echo $address  ?>"  readonly>
                <!-- -------------- -->
                <input type="hidden" name="totalPriceOrder" value="<?php echo $totalPriceOrder ?>">
                <input type="hidden" name="orderNumber" value="<?php echo $orderNumber ?>">
                <!-- -------------- -->
                <?php echo $msglang["city"] ?><input type="text" name="city" >
                <?php echo $msglang["postalCode"] ?><input type="number" name="postalCode" >
                
                <?php echo $msglang["phone"] ?><input type="text" value="<?php if(isset($phone)) echo $phone ?>" readonly>
                <?php echo $msglang["paymentType"] ?><select> 
                <option value="Cash_on_Delivery"><?php echo $msglang["Cash on Delivery"] ?></option>
                </select>
                <button class="normal" name="submit" type="submit" > <?php echo $msglang["proceed to checkout"] ?></button>
            </form>
        </div>

    </section>


    <?php include "footer.php" ?>