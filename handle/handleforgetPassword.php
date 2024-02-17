<?php

require_once "../inc/connection.php";

if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    //  catch data
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];
    if(empty($email)) {
        $errors[] = "email is require";
    } elseif(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email Not Correct";
    }

    if(empty($new_password)) {
        $errors[] = "password is require";
    } elseif($new_password != $confirm_password) {
        $errors[] = "Password error";
    } elseif(strlen($new_password) <= 8) {
        $errors[] = "password must be gegger than 8";
    }
    if(empty($errors)) {
        //  check if email is found
        $query = "SELECT `idcustomer` FROM `customers` WHERE `email` = '$email'";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery) == 1) {
            $idcustomer = mysqli_fetch_assoc($runQuery)['idcustomer'];
            $passwordHashed = password_hash($new_password, PASSWORD_DEFAULT);

            //  update password from database
            $query = "UPDATE `customers` SET `password` = '$passwordHashed' WHERE `idcustomer` = '$idcustomer' AND `email` = '$email' ";
            $runQuery = mysqli_query($conn, $query);
            if($runQuery) {
                    $valid_remember_me = isset($_POST['remember_me']);
                    if($valid_remember_me) {
                        setcookie("email",$email,time()+60*60*24*15);
                        setcookie("password",$password,time()+60*60*24*15);
                    } else {
                        if(isset($_COOKIE["email"])) {
                            setcookie("email",$email,time()-100);
                            setcookie("password",$password,time()-100);
                        }
                    }
                unset($_SESSION['customer_id']);
                $_SESSION['success'] = "The password has been modified successfully";
                header("location: ../login.php");
            }
            
        } else {
            $_SESSION['errors'] = ["There is an error in the email used"];
            header("location: ../forgetPassword.php");
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location: ../forgetPassword.php");
    }


        
} else {
    header("location: ../signup.php");
}