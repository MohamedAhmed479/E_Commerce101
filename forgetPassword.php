<?php
include "header.php";
include "navbar.php";
require_once "inc/errors.php";
?>


<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
    
            
              <div class="card-body px-5 py-5" style="background-color:darkgray;">
                <h3 class="card-title text-left mb-3"><?php echo $msglang["Login"] ?></h3>
                
                <form action="handle/handleforgetPassword.php" method="post" >
                  <div class="form-group">
                    <label><?php echo $msglang["email"] ?> *</label>
                    <input type="email" name="email" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label> <?php echo $msglang["New Password"] ?> *</label>
                    <input type="password" name="new_password" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label> <?php echo $msglang["Confirm Password"] ?> *</label>
                    <input type="password" name="confirm_password" class="form-control p_input" >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="remember_me" class="form-check-input"> <?php echo $msglang["Remember me"] ?></label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass"><?php echo $msglang["Forgot password"] ?></a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn" ><?php echo $msglang["Confirm"] ?></button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> <?php echo $msglang["Facebook"] ?></button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> <?php echo $msglang["Google plus"] ?> </button>
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


