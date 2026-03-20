<?php
include "connect.php";

if(!isset($_SESSION['user_id'])){
header("location:login.php");
}

$user_id=$_SESSION['user_id'];
$product_id=$_GET['id'];

// clear old cart (optional but recommended)
mysqli_query($conn,"DELETE FROM cart WHERE user_id='$user_id'");

// insert only this product
mysqli_query($conn,
"INSERT INTO cart(user_id,product_id,quantity)
VALUES('$user_id','$product_id','1')");

// redirect to checkout
header("location:checkout.php");
?>