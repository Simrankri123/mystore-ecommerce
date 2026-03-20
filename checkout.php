<?php include "connect.php";

$user_id=$_SESSION['user_id'];

// total calculate
$result=mysqli_query($conn,
"SELECT products.price 
FROM cart 
JOIN products ON cart.product_id=products.id
WHERE cart.user_id='$user_id'");

$total=0;
while($row=mysqli_fetch_assoc($result)){
$total += $row['price'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="auth-body">

<div class="checkout-container">

<h2>Delivery Details 📦</h2>

<form action="payment.php" method="POST">

<input type="text" name="name" placeholder="Full Name" required>
<input type="text" name="address" placeholder="Address" required>
<input type="text" name="mobile" placeholder="Mobile Number" required>

<p class="total">Total: ₹<?php echo $total; ?></p>

<input type="hidden" name="total" value="<?php echo $total; ?>">

<button class="next-btn">Continue to Payment</button>

</form>

</div>

</body>
</html>