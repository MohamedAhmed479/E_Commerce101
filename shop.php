<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php require_once "inc/connection.php"; ?>
<?php require_once "inc/function.php"; ?>

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
          
          if(isset($_GET['page']) and $_GET['page'] > 1 ) {
            $page = $_GET['page'];
          } else {
            $page = 1;
          }

          $limit = 4;

          $offset = ($page - 1) * $limit;

          $query = "SELECT * FROM products order By `buyPrice` DESC  LIMIT $limit OFFSET $offset ";
          $runQuery = mysqli_query($conn, $query);
          if(mysqli_num_rows($runQuery) > 0) {
            $products = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
          } else {
            $msg = "No Posts Founded";
          }
      ?>

      <?php 
          require_once 'inc/success.php';
          require_once 'inc/errors.php';
      ?>


      <?php 
        $query = "SELECT COUNT(`productCode`) AS total FROM `products`";
        $runQuery = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($runQuery);
        $total = $result['total'];
        $numberOfPages = ceil($total / $limit);

        if(! check($page, $numberOfPages)) {
          header("location: {$_SERVER['PHP_SELF']}?Page=1");
        }
        if($page < 1) {
          header("location: {$_SERVER['PHP_SELF']}?Page=1");
        }
      ?>


    <section id="product1" class="section-p1">
        <h2><?php echo $msglang["Featured Products"] ?></h2>
        <p><?php echo $msglang["Summer Collection New Modren Desgin"] ?></p>
        <div class="pro-container">

          <?php 
            if(! empty($products)):
              foreach ($products as $product) :
          ?>

            <div class="pro">
                <form action="handle/addNewOrder.php?productId=<?php echo $product['productCode'] ?>" method="post"> 
                    <img src="img/products/<?php echo $product["image"] ?>" alt="p1" />
                    <div class="des" >
                        <h3> <?php echo $product["productName"] ?> </h3>
                        <h5> <?php echo $product["productDescription"] ?> </h5>
                        
                        <div class="star ">
                            <?php 
                            $count_star = $product['star'];
                            for ($i=0; $i < $count_star; $i++) { ?>
                                <i class="fas fa-star"></i>
                            <?php } ?>
                        </div>
                        <h4> <?php echo $product["buyPrice"] ?> </h4>

                        <input type="number" name="quantity">
                        <button type="submit" class="cart"><i class="fas fa-shopping-cart "></i></button>
                    </div>
                </form>
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

    $nextPage = $page + 1;
    $lastPage = $page - 1;
    ?>

    <section id="pagenation" class="section-p1">
    <nav aria-label="Page navigation example" >
  <ul class="pagination">
    <li class="page-item <?php if($page == 1) echo "disabled" ?>">
      <a class="page-link" href="shop.php?page=<?php echo $lastPage ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only"><?php echo $msglang["Previous"] ?></span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" > <?php echo $page ?> of <?php echo $numberOfPages ?> </a></li>
 
    <li class="page-item <?php if($page == $numberOfPages) echo "disabled" ?>">
      <a class="page-link" href="shop.php?page=<?php echo $nextPage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only"><?php echo $msglang["Next"] ?></span>
      </a>
    </li>
  </ul>
</nav>

    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext ">
            <h4><?php echo $msglang["Sign Up For Newletters"] ?></h4>
            <p><?php echo $msglang["Get E-mail Updates about our latest shop and"] ?><span class="text-warning "><?php echo $msglang["Special Offers."] ?></span></p>
        </div>
        <div class="form ">
            <input type="text " placeholder="<?php echo $msglang["Enter Your E-mail..."] ?>">
            <button class="normal "><?php echo $msglang["Sign Up"] ?></button>
        </div>
    </section>


    <?php include 'footer.php' ?>