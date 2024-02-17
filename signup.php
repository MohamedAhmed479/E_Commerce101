<?php
include "header.php";
include "navbar.php";

require_once 'inc/errors.php'; 
?>

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


              <div class="card-body px-5 py-5" style="background-color:darkgray;">
                <h3 class="card-title text-left mb-3"><?php echo $msglang["Register"] ?></h3>

                <form action="handle/handleSignup.php" method="post">

                  <div class="form-group">
                    <label><?php echo $msglang["Username"] ?></label>
                    <input type="text" class="form-control p_input" name="username" value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; unset($_SESSION['username']) ?>" >
                  </div>

                  <div class="form-group">
                    <label><?php echo $msglang["email"] ?></label>
                    <input type="email" class="form-control p_input" name="email" value="<?php if(isset($_SESSION['email']) && ! isset($_SESSION['customer_id'])) echo $_SESSION['email']; unset($_SESSION['email']) ?>" >
                  </div>

                  <div class="form-group">
                    <label><?php echo $msglang["Password"] ?></label>
                    <input type="password" class="form-control p_input" name="password" value="<?php if(isset($_SESSION['password']) && ! isset($_SESSION['customer_id'])) echo $_SESSION['password']; unset($_SESSION['password']) ?>" >
                  </div>

                  <div class="form-group">
                    <label><?php echo $msglang["phone"] ?></label>
                    <input type="text" class="form-control p_input"  name="phone" value="<?php if(isset($_SESSION['phone'])) echo $_SESSION['phone']; unset($_SESSION['phone']) ?>" >
                  </div>

                  <div class="form-group">
                    <label><?php echo $msglang["address"] ?></label>
                    <input type="text" class="form-control p_input" name="address" value="<?php if(isset($_SESSION['address'])) echo $_SESSION['address']; unset($_SESSION['address']) ?>">
                  </div>
              
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                  
                     
                  <div class="text-center">
                    <button type="submit"  class="btn btn-primary btn-block enter-btn" name="signup" ><?php echo $msglang["Sign Up"] ?></button>
                  </div>

                  <div class="d-flex">
                    <button class="btn btn-facebook col me-2">
                      <i class="mdi mdi-facebook"></i> <?php echo $msglang["Facebook"] ?></button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i><?php echo $msglang["Google plus"] ?> </button>
                  </div>

                  <p class="sign-up text-center"><?php echo $msglang["Already have an Account?"] ?><a href="login.php"> <?php echo $msglang["Login"] ?></a></p>
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

    <?php include "footer.php" ?>