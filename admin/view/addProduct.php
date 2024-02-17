<?php
require_once "../../inc/connection.php";

include "../view/header.php";

include "../view/sidebar.php";
include "../view/navbar.php";

?>

      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">

              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Product</h3>

                <form method="POST" action="handle/handleAddProduct.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>productCode</label>
                    <input type="text" value="<?php if(isset($_SESSION["productCode"])) echo $_SESSION["productCode"]; unset($_SESSION["productCode"]) ?>" name="productCode" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" value="<?php if(isset($_SESSION["title"])) echo $_SESSION["title"]; unset($_SESSION["title"]) ?>" name="title" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" value="<?php if(isset($_SESSION["description"])) echo $_SESSION["description"]; unset($_SESSION["description"]) ?>" name="desc" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" value="<?php if(isset($_SESSION["price"])) echo $_SESSION["price"]; unset($_SESSION["price"]) ?>" name="price" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" value="<?php if(isset($_SESSION["quantity"])) echo $_SESSION["quantity"]; unset($_SESSION["quantity"]) ?>" name="quantity" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Quantity star</label>
                    <input type="number" value="<?php if(isset($_SESSION["quantity_star"])) echo $_SESSION["quantity_star"]; unset($_SESSION["quantity_star"]) ?>" name="Quantity_star" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
                  </div>
                
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <?php
        require_once "../../inc/success.php";
        require_once "../../inc/errors.php";
                ?>

<?php 
include "../view/footer.php";
 ?>