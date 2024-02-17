<?php
session_start();
include "header.php";
include "navbar.php";
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
              <?php require_once "inc/success.php"; 
              require_once "inc/errors.php"; 
              ?>
                <h3 class="card-title text-left mb-3"><?php echo $msglang["Login"] ?></h3>
                <form action="handle/handleLogin.php" method="post">

                <div class="form-group">
                    <label><?php echo $msglang["email"] ?> *</label>
                    <input type="email" class="form-control p_input" name="email" value="<?php if(isset($_SESSION["login_email"])) echo $_SESSION["login_email"]; ?>">
                </div>

                <div class="form-group">
                    <label><?php echo $msglang["Password"] ?> *</label>
                    <input type="password" class="form-control p_input" name="password" value="<?php if(isset($_SESSION["login_password"])) echo $_SESSION["login_password"]; ?>">
                </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="remember_me" class="form-check-input"> <?php echo $msglang["Remember me"] ?> </label>
                    </div>

                    <a href="forgetPassword.php" class="forgot-pass"><?php echo $msglang["Forgot password"] ?></a>
                    
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn" name="login"><?php echo $msglang["Login"] ?></button>
                  </div>

                  <p class="sign-up"><?php echo $msglang["Don't have an Account?"] ?><a href="signup.php"><?php echo $msglang["Sign Up"] ?></a></p>
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


