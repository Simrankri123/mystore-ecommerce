<?php include "connect.php";

$search=$_GET['search'];

$result=mysqli_query($conn,
"SELECT * FROM products WHERE name LIKE '$search%'");

while($row=mysqli_fetch_assoc($result)){
?>

<div class="product-card">

<img src="images/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p>₹<?php echo $row['price']; ?></p>

<a class="btn" href="add_to_cart.php?id=<?php echo $row['id']; ?>">
Add to Cart
</a>

</div>

<?php } ?>