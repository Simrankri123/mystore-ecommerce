<?php include "connect.php";

$user_id=$_SESSION['user_id'];

$orders=mysqli_query($conn,
"SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h2 class="order-title">📦 My Orders</h2>

<div class="orders-container">

<?php while($order=mysqli_fetch_assoc($orders)){ ?>

<div class="order-card">

<div class="order-header">
<span>Order #<?php echo $order['id']; ?></span>
<span class="status"><?php echo $order['status']; ?></span>
</div>

<p class="order-info">
₹<?php echo $order['total']; ?> • <?php echo $order['created_at']; ?>
</p>

<?php
$items=mysqli_query($conn,
"SELECT products.*, order_items.quantity 
FROM order_items 
JOIN products ON order_items.product_id=products.id
WHERE order_items.order_id='".$order['id']."'");

while($item=mysqli_fetch_assoc($items)){
?>

<div class="order-item">

<img src="images/<?php echo $item['image']; ?>">

<div class="item-details">
<h4><?php echo $item['name']; ?></h4>
<p>Qty: <?php echo $item['quantity']; ?></p>
<p class="price">₹<?php echo $item['price']; ?></p>
</div>

</div>

<?php } ?>

</div>

<?php } ?>

</div>

</body>
</html>