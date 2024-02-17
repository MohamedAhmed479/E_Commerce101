<?php 
    session_abort();  
    session_start();

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

<section id="header">
<a href="index.php">
    <img src="img/logo.png" alt="homeLogo">
</a>


<div>
    <ul id="navbar">


        <li class="link">
            <a href="shop.php"><?php echo $msglang['Shop'] ?></a>
        </li>
        <li class="link">
            <a href="about.php"><?php echo $msglang['About'] ?></a>
        </li>
        <li class="link">
            <a href="contact.php"><?php echo $msglang['Contact'] ?></a>
        </li>

        <?php if(empty($_SESSION['customer_id'])) : ?>
        <li class="link">
            <a href="signup.php"><?php echo $msglang['Sign Up'] ?></a>
        </li>
        <?php endif; ?>
        <?php  if(($_SESSION['lang']) == "ar") : ?>
        <li class="link">
            <a href="lang.php?lang=en"><?php echo $msglang['English'] ?></a>
        </li>
        <?php  elseif(($_SESSION['lang']) == "en") : ?>
        <li class="link">
            <a href="lang.php?lang=ar"><?php echo $msglang['Arabic'] ?></a>
        </li>
        <?php  endif; ?>




        <?php if(isset($_SESSION['customer_id'])) : ?>
        <li class="link">
            <a href="logout.php"><?php echo $msglang['Logout'] ?></a>
        </li>

        <li class="link">
            <a href="Myorders.php"><?php echo $msglang['My orders'] ?></a>
        </li>

        <?php else : ?>
        <li class="link">
            <a href="login.php"><?php echo $msglang['Login'] ?></a>
        </li>

        <?php endif; ?>


        <li class="link">
            <a id="lg-cart" href="cart.php">
                <i class="fas fa-shopping-cart"></i> 
            </a>
        </li>
        <a href="#" id="close"><i class="fas fa-times"></i> </a>
    </ul>

</div>

<div id="mobile">
    <a href="cart.php">
        <i class="fas fa-shopping-cart"></i>
    </a>
    <a href="#" id="bar"> <i class="fas fa-outdent"></i> </a>
</div>
</section>
