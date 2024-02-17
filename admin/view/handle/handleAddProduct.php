<?php
require_once "../../../inc/connection.php";

if(isset($_POST['addProduct'])) {
    $productCode = htmlspecialchars(trim($_POST['productCode']));
    $productName = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['desc']));
    $price = htmlspecialchars(trim($_POST['price']));
    $quantity = htmlspecialchars(trim($_POST['quantity']));
    $quantity_star = htmlspecialchars(trim($_POST['Quantity_star']));
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imagetmpName = $image['tmp_name'];
    $size = $image['size']/(1024*1024);
    $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $error = $image['error'];
    $newImageName = uniqid()."."."$ext";
    $extintions = ["png", "jpg", "jpeg", "gif"];

    $errors = [];
    

    if(empty($productCode)) {
        $errors[] = "productCode is require";
    } elseif(is_numeric($productName)) {
        $errors[] = "productCode must be string";
    }

    if(empty($productName)) {
        $errors[] = "Title is require";
    } elseif(is_numeric($productName)) {
        $errors[] = "Title must be string";
    }

    if(empty($description)) {
        $errors[] = "description is require";
    } elseif(is_numeric($description)) {
        $errors[] = "description must be string";
    }

    if(empty($price)) {
        $errors[] = "price is require";
    } elseif(! is_numeric($price)) {
        $errors[] = "price must be numeric";
    } elseif($price <= 0) {
        $errors[] = "price must be bigger than 0";
    }

    if(empty($quantity)) {
        $errors[] = "quantity is require";
    } elseif(! is_numeric($quantity)) {
        $errors[] = "quantity must be numeric";
    } elseif($quantity <= 0) {
        $errors[] = "quantity must be equal 1 or more...";
    }

    
    if (empty($quantity_star)) {
        $errors[] = "Quantity star is required";
    } elseif (!is_numeric($quantity_star)) {
        $errors[] = "Quantity star must be numeric";
    } elseif ($quantity_star < 0 || $quantity_star > 5) {
        $errors[] = "The number of stars must be from 0 to 5";
    }
    

    // image
    if($error != 0) {
        $errors[] = "image is require";
    } elseif(! in_array($ext, $extintions)) {
        $errors[] = "image not correct";
    } elseif($size > 1) {
        $errors[] = "image largest size";
    }


    if(empty($errors)) {
        // add product
        $query = "INSERT INTO `products`(`productCode`,`productName`,`productDescription`,`quantityInStock`,`buyPrice`,`image`, `star`)
                        VALUES('$productCode','$productName','$description','$quantity','$price','$newImageName','$quantity_star')";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            move_uploaded_file($imagetmpName, "../../../img/products/$newImageName");
            $_SESSION['success'] = "product added successfuly";
            header("location: ../addProduct.php");
        } else {
            $_SESSION['errors'] = ['error while add product'];
            header("location: ../addProduct.php");
        }

    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['productCode'] = $productCode;
        $_SESSION['title'] = $productName;
        $_SESSION['description'] = $description;
        $_SESSION['price'] = $price;
        $_SESSION['quantity'] = $quantity;
        $_SESSION['quantity_star'] = $quantity_star;
        header("location: ../addProduct.php");
        
    }

} else {
    header("location: ../addProduct.php");
}
?>





