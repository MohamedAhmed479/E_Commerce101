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



<footer class="section-p1">
        <div class="col">
            <a href="index.html"><img class="logo" src="img/logo.png" alt=""></a>
            <h4><?php echo $msglang['Contact'] ?></h4>
            <p><strong><?php echo $msglang['Address:'] ?></strong><?php echo $msglang['526 manchster Road, street 32, manchster'] ?></p>
            <p><strong><?php echo $msglang['Phone:'] ?></strong>0106244875</p>
            <p><strong><?php echo $msglang['Hourse:'] ?></strong><?php echo $msglang['10AM - 10Pm, Sat- thus'] ?></p>
            <div class="follow">
                <h4><?php echo $msglang['Follow US :'] ?></h4>
                <div class="icon">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

        </div>
        <div class="col">
            <h4><?php echo $msglang['About Us'] ?></h4>
            <a href="about.php"><?php echo $msglang['About Us'] ?></a>
            <a href="Terms&Condtions.php"><?php echo $msglang['Terms & Condtions'] ?></a>
            <a href="contact.php"><?php echo $msglang['Contact Us'] ?></a>
        </div>
        <div class="col">
            <h4><?php echo $msglang['My Account'] ?></h4>
            <?php if(! isset($_SESSION['customer_id'])) { ?>
                    <a href="signup.php"><?php echo $msglang['Sign Up'] ?></a>    
            <?php }  ?>

            <a href="cart.php"><?php echo $msglang['View Cart'] ?></a>
            <a href="contact.php"><?php echo $msglang['Help'] ?></a>
        </div>
        <div class="col install">
            <h4><?php echo $msglang['Install App'] ?></h4>
            <p><?php echo $msglang['From App Store Or Google Play'] ?></p>
            <div class="oo">
                <img src="img/pay/app.jpg " alt=" ">
                <img src="img/pay/play.jpg " alt=" ">
            </div>
            <p>Secure payment For your happy Service</p>
            <img src="img/pay/pay.png " alt=" ">
        </div>


    </footer>


    <script src="js/all.min.js "></script>
    <script src="js/bootstrap.bundle.min.js "></script>
    <script src="js/main.js"></script>
</body>

</html>

</html>