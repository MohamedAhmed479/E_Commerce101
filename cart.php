<?php include 'header.php' ?>
<?php include 'navbar.php' ?>
<?php include 'inc/connection.php' ?>
<?php include 'inc/success.php' ?>


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
if(isset($_SESSION['totalPriceProductsAfterDesc']) && $_SESSION['totalPriceProductsAfterDesc'] == 0) {
    unset($_SESSION['totalPriceProductsAfterDesc']);
}
if(isset($_SESSION['msg']) && $_SESSION['msg'] == 0) {
    unset($_SESSION['msg']);
}
?>

<?php
if(! isset($_SESSION['customer_id'])) {
    header("location: login.php");
}
?>

<section id="page-header" class="about-header"> 
        <h2><?php echo $msglang['#Cart'] ?></h2>
        <p><?php echo $msglang["Let's see what you have."] ?></p>
    </section>


 
    <section id="cart" class="section-p1">
        <table width="100%">

            <thead>
                <tr>
                    <td><?php echo $msglang["Image"] ?></td>
                    <td><?php echo $msglang["Name"] ?></td>
                    <td><?php echo $msglang["Quantity"] ?></td>
                    <td><?php echo $msglang["price"] ?></td>
                    <td><?php echo $msglang["Subtotal"] ?></td>
                    <td><?php echo $msglang["Remove"] ?></td>
                </tr>
            </thead>

   

            <?php
            $customerId = $_SESSION['customer_id'];
            $query = "SELECT `orderNumber` FROM `orders` WHERE `customerNumber` = $customerId AND `status` = 'in the cart'";
            $runQuery = mysqli_query($conn, $query);
            if(mysqli_num_rows($runQuery) == 1) {
                $orderNumber = mysqli_fetch_assoc($runQuery)['orderNumber'];

                $query = "SELECT * FROM `orderdetails` WHERE orderNumber = '$orderNumber'";
                $runQuery = mysqli_query($conn, $query);
                if(mysqli_num_rows($runQuery) >= 1) {
                    $isEmty = false;
                    $products = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
                    $totalPriceProducts = 0;
                    foreach ($products as $product) { ?>
                        <?php 
                            $productCode = $product["productCode"];
                            $query = "SELECT `productName`, `image` FROM `products` WHERE productCode = '$productCode'";
                            $runQuery = mysqli_query($conn, $query);
                            if(mysqli_num_rows($runQuery) == 1) {
                                $productInCart = mysqli_fetch_assoc($runQuery);
                                $productName = $productInCart['productName'];
                                $productImage = $productInCart['image'];
                            }
                        
                        ?>
                        <tbody>
                            <tr>
                                <td><img src="img/products/<?php echo $productImage ?>" alt="product1"></td>
                                <td> <?php echo $productName ?> </td>
                                <td> <?php echo $product['quantityproduct'] ?> </td>
                                <td> <?php echo $product['priceEach'] ?> </td>
                                
                                <?php 
                                $Subtotal = $product['quantityproduct'] * $product['priceEach']; 
                                $totalPriceProducts = $totalPriceProducts + $Subtotal;
                                ?>

                                <td> <?php echo $Subtotal ?> </td>
                                <!-- Remove any cart item  -->
                                <form action="handle/removeFromCart.php" method="post">
                                    <input type="hidden" name="quantityproduct" value="<?php echo $product['quantityproduct'] ?>">
                                    <input type="hidden" name="orderNumber" value="<?php echo $orderNumber ?>">
                                    <input type="hidden" name="productCode" value="<?php echo $productCode ?>">

                                    <td>
                                        <button type="submit" name="Remove" class="btn btn-danger"><?php echo $msglang["Remove"] ?></button>
                                    </td>
                                </form>
                                
                                
                                
                            </tr>
                        </tbody>   

                   <?php }
                    
                } else { 
                    if(isset($_SESSION['coupon'])) {
                        unset($_SESSION['coupon']);
                    }
                    $msg = $msglang["You don't have any product in your cart now"];
                    $isEmty = true;
                    ?>
                    <div style="background-color: #f8d7da; padding: 20px; border: 1px solid #f5c6cb; border-radius: 5px; margin: 10px 0;">
                        <p style="color: #721c24;"> <?php echo $msg ?></p>
                    </div>
                  
                <?php }
                


            } else {
                $msg =  $msglang["You don't have any orders now"];
                ?>
                    <div style="background-color: #f8d7da; padding: 20px; border: 1px solid #f5c6cb; border-radius: 5px; margin: 10px 0;">
                        <p style="color: #721c24;"> <?php echo $msg ?></p>
                    </div>

            <?php }


?>



        </table>
    </section>
        <form action="handle/removeAllCart.php" method="post">
            <button type="submit" name="removeAll" class="btn btn-danger"><?php echo $msglang["Remove All Items"] ?></button>
            <input type="hidden" name="orderNumber" value="<?php echo $orderNumber ?>">
        </form>  

                
            <?php if(isset($isEmty)) {
                if(! $isEmty) { ?>
                
            
                <section id="cart-add" class="section-p1">
                            <form id="coupon" action="handle/handleCoupon.php" method="post">
                                <h3><?php echo $msglang["Coupon"] ?></h3>
                                <input type="text" id="coupon-code" value="<?php if(isset($_SESSION['coupon'])) echo $_SESSION['coupon'] ?>" name="coupon-code" placeholder="<?php echo $msglang["Enter coupon code"] ?>">
                                <input type="hidden" name="totalPriceProducts" value="<?php echo $totalPriceProducts ?>">
                                <button  type="submit" name="submit" class="normal"><?php echo $msglang["Apply"] ?></button>
                                <?php 
                                    echo "<br>";
                                    echo "<br>";
                                    if(isset($_SESSION['totalPriceProductsAfterDesc'])) {
                                        $discountValue = $totalPriceProducts - $_SESSION['totalPriceProductsAfterDesc'];
                                        $totalPriceProducts = $_SESSION['totalPriceProductsAfterDesc'];
                                        $_SESSION['totalPriceProductsAfterDesc'] = 0;
                                    } elseif (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        $_SESSION['msg'] = 0;
                                    }
                                ?>
                                <a href="index.php#sm-bannar" class="btn btn-primary"> <?php echo $msglang["Available coupons"] ?> </a>
                            </form>
                            
                            

                            <div id="subTotal">
                                <h3><?php echo $msglang["Cart totals"] ?></h3>
                                <table>
                                    <tr>
                                        <td><?php echo $msglang["Subtotal"] ?></td>
                                        <td>$<?php echo $totalPriceProducts ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $msglang["Shipping"] ?></td>
                                        <td>$<?php echo 50 ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $msglang["Discount"] ?></td>
                                        <?php
                                            if(isset($discountValue)) { ?>
                                                <td>$<?php echo $discountValue ?></td>
                                            <?php } else { ?>
                                                <td><?php echo $msglang["No Discount"] ?></td>
                                            <?php }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td><?php echo $msglang["Tax"] ?></td>
                                        <?php $Tax = $totalPriceProducts * 2.5/100;?>
                                        <?php $totalPriceOrder = $totalPriceProducts + $Tax + 50; ?>
                                        <td>$<?php echo $Tax; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo $msglang["Total"] ?></strong></td>
                                        <td><strong>$<?php echo $totalPriceOrder; ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                </section> 

            <?php } 
            } ?>


            <?php if(isset($isEmty)) {
                if(! $isEmty) { ?>
                <!-- confirm order  -->
                <form action="confirmOrder.php" method="post">
                    <!-- form fields here -->
                    <td>
                        <input type="hidden" name="totalPriceOrder" value="<?php echo $totalPriceOrder ?>">
                        <input type="hidden" name="orderNumber" value="<?php echo $orderNumber ?>">
                        <button type="submit" name="submit" class="btn btn-success" style="margin-right: 20px; padding: 20px 30px;"><?php echo $msglang["Confirm"] ?></button>
                    </td>
                </form>
            <?php } 
            } ?>

            


            <?php include "footer.php" ?>
