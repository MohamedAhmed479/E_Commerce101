<?php
require_once '../inc/connection.php';

if(isset($_POST['signup'])) {
    // catch dat and filtar
    $UserName = htmlspecialchars(trim($_POST['username']));
    $Email = htmlspecialchars(trim($_POST['email']));
    $Password = htmlspecialchars(trim($_POST['password']));
    $Phone = htmlspecialchars(trim($_POST['phone']));
    $Address = htmlspecialchars(trim($_POST['address']));

    // validation
    $errors = [];

    if(empty($UserName)) {
        $errors[] = "Username is require.";
    } elseif(! is_string($UserName)) {
        $errors[] = "Username must be string.";
    } elseif(strlen($UserName) < 6) {
        $errors[] = "Username must be bigger than 6.";
    }


    if(empty($Email)) {
        $errors[] = "Email is require.";
    } elseif(! filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }


    if(empty($Password)) {
        $errors[] = "Password is require.";
    } elseif(! is_string($Password)) {
        $errors[] = "Password must be string.";
    } elseif(strlen($Password) < 8) {
        $errors[] = "Password must be bigger than 8.";
    }


    if(empty($Phone)) {
        $errors[] = "Phone is require.";
    } elseif(! is_string($Phone)) {
        $errors[] = "Phone must be string.";
    } elseif(strlen($Phone) < 13) {
        $errors[] = "Phone must be equal 14. write the country code";
    }

    if(empty($Address)) {
        $errors[] = "Address is require.";
    } elseif(! is_string($Address)) {
        $errors[] = "Address must be string.";
    }
    
    $query = "SELECT email FROM customers WHERE email = '$Email'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $errors[] = "email is already registered.";
    }

    $passwordHashed = password_hash($Password, PASSWORD_DEFAULT);

    // check about errors
    if(empty($errors)) {
        $query = "INSERT INTO customers(`username`, `password`, `phone`, `customeraddres`, `email`) VALUES('$UserName', '$passwordHashed', '$Phone', '$Address', '$Email')";
        $runQuery = mysqli_query($conn, $query);
        
        if($runQuery) {
            $_SESSION['success'] = "You have been added successfully";
            header("location: ../login.php");

        } else {
            $_SESSION['errors'] = ["error while insert"];
            header("location: ../signup.php");
        }
    } else {
        header("location: ../signup.php");
        $_SESSION['errors'] = $errors;
        $_SESSION['username'] = $UserName;
        $_SESSION['email'] = $Email;
        $_SESSION['password'] = $Password;
        $_SESSION['address'] = $Address;
        $_SESSION['phone'] = $Phone;
    }


} else {
    header("location: ../signup.php");
}