<?php include "connect.php";

$user_id=$_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h2 style="text-align:center;">🛒 Your Cart</h2>

<div class="cart-container">

<?php

$result=mysqli_query($conn,
"SELECT products.*, cart.id as cid, cart.quantity 
FROM cart 
JOIN products ON cart.product_id = products.id
WHERE cart.user_id='$user_id'");

$total=0;

while($row=mysqli_fetch_assoc($result)){
?>

<div class="cart-item">

<img src="images/<?php echo $row['image']; ?>">

<div class="cart-info">
<h3><?php echo $row['name']; ?></h3>
<p>₹<?php echo $row['price']; ?></p>

<div class="qty-box">

<button onclick="updateQty(<?php echo $row['cid']; ?>,'dec')">➖</button>

<span id="qty-<?php echo $row['cid']; ?>">
<?php echo $row['quantity']; ?>
</span>

<button onclick="updateQty(<?php echo $row['cid']; ?>,'inc')">➕</button>

</div>

<a class="remove-btn" href="remove.php?id=<?php echo $row['cid']; ?>">Remove</a>

</div>

</div>

<?php
$total += $row['price'] * $row['quantity'];
}
?>

</div>

<div class="cart-summary">
<h3>Total: ₹<span id="total"><?php echo $total; ?></span></h3>

<a href="checkout.php">
<button class="order-btn">Order Now</button>
</a>
</div>

<script>
function updateQty(id, action){

fetch("update_quantity.php",{
method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},
body:"id="+id+"&action="+action
})
.then(res=>res.json())
.then(data=>{

document.getElementById("qty-"+id).innerText=data.qty;
document.getElementById("total").innerText=data.total;

});
}
</script>

</body>
</html>