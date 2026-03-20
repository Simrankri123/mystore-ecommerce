<?php
include "connect.php";

if(!isset($_SESSION['user_id'])){
header("location:login.php");
}

$user_id=$_SESSION['user_id'];
$id=$_GET['id'];

// check if already in cart
$check=mysqli_query($conn,
"SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$id'");

if(mysqli_num_rows($check)>0){

mysqli_query($conn,
"UPDATE cart SET quantity = quantity + 1 
WHERE user_id='$user_id' AND product_id='$id'");

}else{

mysqli_query($conn,
"INSERT INTO cart(user_id,product_id,quantity)
VALUES('$user_id','$id','1')");

}

header("location:home.php");
?>