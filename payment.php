<?php
include "connect.php";

$name=$_POST['name'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$total=$_POST['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="auth-body">

<div class="payment-container">

<h2>Payment 💳</h2>

<div class="payment-details">
<p><b>Name:</b> <?php echo $name; ?></p>
<p><b>Total Amount:</b> ₹<?php echo $total; ?></p>
</div>

<h3>Select Payment Method</h3>

<form action="place_order.php" method="POST">

<input type="hidden" name="name" value="<?php echo $name; ?>">
<input type="hidden" name="address" value="<?php echo $address; ?>">
<input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
<input type="hidden" name="total" value="<?php echo $total; ?>">

<div class="payment-option">
<input type="radio" name="payment" required> Cash on Delivery
</div>

<div class="payment-option">
<input type="radio" name="payment"> UPI
</div>

<div class="payment-option">
<input type="radio" name="payment"> Debit/Credit Card
</div>

<button class="pay-btn">Pay Now</button>

</form>

</div>

</body>
</html>