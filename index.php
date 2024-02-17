<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php require_once 'inc/connection.php'; ?>

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


<section id="hero">

        <h4><?php echo $msglang['Trade-in-offer'] ?> </h4>
        <h2><?php echo $msglang['Super value deals'] ?></h2>
        <h1><?php echo $msglang['On all products'] ?></h1>
        <p><?php echo $msglang['Save more with coupons & up to 70% off!'] ?></p>
        
        <button onclick="redirectToPage()" ><?php echo $msglang['Shop Now!'] ?></button>

        <script>
        function redirectToPage() {
            
            var targetPage = 'shop.php'; 

            window.location.href = targetPage;
        }
        </script>

    </section>

    <!-- End Hero -->

    <?php require_once 'inc/errors.php'; ?>

    <!-- start Feature-->
    <section id="feature" class="section-p1">
        <div class="fe-1">
            <img src="img/features/f1.png" alt="">
            <h6> <?php echo $msglang['Free Shipping'] ?> </h6>
        </div>
        <div class="fe-1">
            <img src="img/features/f2.png" alt="">
            <h6><?php echo $msglang['Online Order'] ?></h6>
        </div>
        <div class="fe-1">
            <img src="img/features/f3.png" alt="">
            <h6> <?php echo $msglang['Save Money'] ?> </h6>
        </div>
        <div class="fe-1">
            <img src="img/features/f4.png" alt="">
            <h6><?php echo $msglang['Promitions'] ?></h6>
        </div>
        <div class="fe-1">
            <img src="img/features/f5.png" alt="">
            <h6><?php echo $msglang['Happy Sell'] ?></h6>
        </div>
        <div class="fe-1">
            <img src="img/features/f6.png" alt="">
            <h6> <?php echo $msglang['F7/24 Support'] ?> </h6>
        </div>
    </section>
    <!-- End Feature-->
    <?php require_once 'inc/success.php'; ?>


    <!-- Start New Arrival or productCard Features -->
    <section id="product1" class="section-p1">
        <h2> <?php echo $msglang['Featured Products'] ?> </h2>
        <p> <?php echo $msglang['Summer Collection New Modren Desgin'] ?> </p>
        <div class="pro-container">
            <?php 
            $query = "SELECT * FROM `products` LIMIT 8";
            $runQuery = mysqli_query($conn, $query);
            if (mysqli_num_rows($runQuery) > 0) {
                $products = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
                $countProducts = count($products);
                $splitArrays = array_chunk($products, ceil($countProducts / 2));

                $sectionOne = $splitArrays[0];
                $sectionTwo = $splitArrays[1];

                unset($products);
                unset($splitArrays);

            } else {
                $msg = "No Products Founded";
            } ?>


            <?php if(! empty($sectionOne)):
                foreach ($sectionOne as $product) :
            ?>

            <div class="pro">
                <img src="img/products/<?php echo $product['image'] ?>" alt="p1">
                <div class="des">
                    <span><?php echo $product['productName'] ?></span>
                    <h5><?php echo $product['productDescription'] ?></h5>
                    <div class="star">
                        <?php 
                        $count_star = $product['star'];
                        for ($i=0; $i < $count_star; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php }
                        ?>
                        
                    </div>
                    <h4><?php echo $product['buyPrice'] ?></h4>
                    <a href="handle/addNewOrder.php?productId=<?php echo $product['productCode'] ?>" class="cart"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>

            <?php 
                endforeach;
            ?>

        </div>
    </section>

    <?php 
    else : 
      echo $msg;
    endif;
    ?>
        
    <!-- End New Arrival -->
    <!-- Start bannar -->
    <section id="bannar" class="section-m1">
        <h4><?php echo $msglang['Repair Service'] ?></h4>
        <h2><?php echo $msglang['Up to'] ?><span><?php echo $msglang['seventen'] ?></span><?php echo $msglang['All t-Shirts & Accessories'] ?></h2>
        <button class="normal"><?php echo $msglang['Explore More'] ?></button>
    </section>
    <!-- End bannar -->

    <section id="product1" class="section-p1">
        <h2><?php echo $msglang['New Arrival'] ?></h2>
        <p><?php echo $msglang['Summer Collection New Modren Desgin'] ?></p>
        <div class="pro-container">

        <?php if(! empty($sectionTwo)):
                foreach ($sectionTwo as $product) :
        ?>

            <div class="pro">
                <img src="img/products/<?php echo $product['image'] ?>" alt="p1">
                <div class="des">
                    <span><?php echo $product['productName'] ?></span>
                    <h5><?php echo $product['productDescription'] ?></h5>
                    <div class="star">
                        <?php 
                        $count_star = $product['star'];
                        for ($i=0; $i < $count_star; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php }
                        ?>
                    </div>

                    <h4><?php echo $product['buyPrice'] ?></h4>
                    <a href="handle/addNewOrder.php?productId=<?php echo $product['productCode'] ?>" class="cart"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>

        <?php 
            endforeach;
        ?>

        </div>
    </section>

    <?php 
    else : 
      echo $msg;
    endif;
    ?>

<style>
    p {
        color: red; 
    }

    .highlight {
        color: blue; 
    }
</style>

    <section id="sm-bannar" class="section-p1">
        <div class="bannar-box">
            <h4><?php echo $msglang['Crazy Deals'] ?></h4>
            <h2><?php echo $msglang['Use the coupon Almsry2024'] ?></h2>
            <span><?php echo $msglang['The best classic dress is on sale from cara'] ?></span>
            <button class="white"><?php echo $msglang['Learn More'] ?></button>
        </div>

        <div class="bannar-box bannar-box2">
            <h4><?php echo $msglang['Spring/Summer'] ?></h4>
            <h2><?php echo $msglang['Use the coupon Rote2024'] ?></h2>
            <span><?php echo $msglang['The best classic dress is on sale from cara'] ?></span>
            <button class="white"><?php echo $msglang['Learn More'] ?></button>
        </div>

    </section>

    <section id="bannar3" class="section-p1">
        <div class="bannar-box">
            <h2><?php echo $msglang['SEASONAL SALE'] ?></h2>
            <h3><?php echo $msglang['Winter Collection - 50% off'] ?></h3>
        </div>
        <div class="bannar-box bannar-box2">
            <h2><?php echo $msglang['SEASONAL SALE'] ?></h2>
            <h3><?php echo $msglang['Winter Collection - 50% off'] ?></h3>
        </div>
        <div class="bannar-box bannar-box3">
            <h2><?php echo $msglang['SEASONAL SALE'] ?></h2>
            <h3><?php echo $msglang['Winter Collection - 50% off'] ?></h3>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4><?php echo $msglang['Sign Up For Newletters'] ?></h4>
            <p><?php echo $msglang['Get E-mail Updates about our latest shop and'] ?><span class="text-warning"><?php echo $msglang['Special Offers.'] ?></span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="<?php echo $msglang['Enter Your E-mail...'] ?>">
            <button class="normal"><?php echo $msglang['Sign Up'] ?></button>
        </div>
    </section>



<?php include 'footer.php'; ?>