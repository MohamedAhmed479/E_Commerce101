<?php
require_once "../inc/connection.php";

if(isset($_POST['login'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if($email == "admin@gmail.com" && $password =="admin")  {
        header("location: ../admin/view/layout.php");
        exit;
    } 

    $errors = [];

    if(empty($email)) {
        $errors[] = "Email is require.";
    } elseif(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }


    if(empty($password)) {
        $errors[] = "Password is require.";
    } elseif(! is_string($password)) {
        $errors[] = "Password must be string.";
    } elseif(strlen($password) < 8) {
        $errors[] = "Password must be bigger than 8.";
    }

    if(empty($errors)) {
        $query = "SELECT idcustomer, email, password FROM `customers` WHERE email='$email'";
        $runQuery = mysqli_query($conn, $query);

        if(mysqli_num_rows($runQuery) == 1) {
            $customer = mysqli_fetch_assoc($runQuery);
            $oldPassword = $customer['password'];
            $isVerify = password_verify($password, $oldPassword);

            if($isVerify) {
                $_SESSION["customer_id"] = $customer['idcustomer'];

                if (isset($_POST['remember_me'])) {
                    $_SESSION['remember_me'] = true;
                } else {
                    $_SESSION['remember_me'] = false;
                }

                if($_SESSION['remember_me']) {
                    $_SESSION["login_email"] = $email;
                    $_SESSION["login_password"] = $password;

                } else {
                    if(isset($_SESSION["login_email"]) && isset($_SESSION["login_password"])) {
                        unset($_SESSION["login_email"]);
                        unset($_SESSION["login_password"]);
                    }
                }
                header("location: ../index.php");

            } else {
                $_SESSION['errors'] = ["creidentials not correct"];
                $_SESSION['email'] = $email;
                header("location: ../Login.php");
            }

        } else {
            $_SESSION['errors'] = ["creidentials not correct"];
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("location: ../Login.php");
        }

    } else {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['errors'] = $errors;
        header("location: ../login.php");
    }



} else {
    header("location: ../login.php");
}