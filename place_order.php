<?php
include "connect.php";

$user_id=$_SESSION['user_id'];

$name=$_POST['name'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$total=$_POST['total'];

// insert order
mysqli_query($conn,
"INSERT INTO orders(user_id,total,name,address,mobile)
VALUES('$user_id','$total','$name','$address','$mobile')");

// get order id
$order_id = mysqli_insert_id($conn);

// get cart items
$cart=mysqli_query($conn,
"SELECT * FROM cart WHERE user_id='$user_id'");

while($item=mysqli_fetch_assoc($cart)){

mysqli_query($conn,
"INSERT INTO order_items(order_id,product_id,quantity)
VALUES('$order_id','".$item['product_id']."','".$item['quantity']."')");

}

// clear cart
mysqli_query($conn,
"DELETE FROM cart WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Success</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="success-body">

<div class="success-box">
<h1>🎉 Order Confirmed!</h1>
<p>Your order has been placed successfully</p>

<a href="home.php" class="home-btn">Go to Home</a>
</div>

</body>
</html>