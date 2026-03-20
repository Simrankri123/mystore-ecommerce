<?php include "connect.php";

if(!isset($_SESSION['user_id'])){
header("location:login.php");
}

$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'];

// cart count
$countRes=mysqli_query($conn,
"SELECT COUNT(*) as total FROM cart WHERE user_id='$user_id'");
$countData=mysqli_fetch_assoc($countRes);
$count=$countData['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>MyShop</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header class="navbar">

<h2 class="logo">MyShop</h2>

<!-- SEARCH BAR -->
<form method="GET" class="search-bar">
<input type="text" id="search" placeholder="Search products..." onkeyup="liveSearch()">
<button type="submit">🔍</button>
</form>

<div class="nav-links">

<a href="cart.php">🛒 (<?php echo $count; ?>)</a>

<div class="profile">
<span onclick="toggleMenu()">👤 <?php echo $user_name; ?></span>

<div id="dropdown" class="dropdown">
<a href="orders.php">My Orders</a>
<a href="logout.php">Logout</a>
</div>

</div>

</div>

</header>
<!-- BANNER -->
<div class="banner">
<div class="banner-content">
<h1>Discover Premium Products</h1>
<p>Best Deals | Fast Delivery | Secure Payment</p>

</div>
</div>


<div class="categories">

<a href="home.php" class="<?php echo !isset($_GET['cat']) ? 'active' : ''; ?>">All</a>

<a href="home.php?cat=Electronics" 
class="<?php echo (isset($_GET['cat']) && $_GET['cat']=='Electronics') ? 'active' : ''; ?>">
Electronics
</a>

<a href="home.php?cat=Fashion"
class="<?php echo (isset($_GET['cat']) && $_GET['cat']=='Fashion') ? 'active' : ''; ?>">
Fashion
</a>

<a href="home.php?cat=Beauty"
class="<?php echo (isset($_GET['cat']) && $_GET['cat']=='Beauty') ? 'active' : ''; ?>">
Beauty
</a>
<a href="home.php?cat=Home essential"
class="<?php echo (isset($_GET['cat']) && $_GET['cat']=='Home essential') ? 'active' : ''; ?>">
Home essential
</a>
</div>

<div class="products">

<?php

if(isset($_GET['search'])){
$search=$_GET['search'];
$result=mysqli_query($conn,
"SELECT * FROM products WHERE name LIKE '%$search%'");
}
else if(isset($_GET['cat'])){
$cat=$_GET['cat'];
$result=mysqli_query($conn,
"SELECT * FROM products WHERE category='$cat'");
}
else{
$result=mysqli_query($conn,"SELECT * FROM products");
}

while($row=mysqli_fetch_assoc($result)){
?>

<div class="product-card">

<img src="images/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p>₹<?php echo $row['price']; ?></p>

<a class="btn" href="add_to_cart.php?id=<?php echo $row['id']; ?>">
Add to Cart
</a>

<a class="btn order-btn" href="order_now.php?id=<?php echo $row['id']; ?>">
Order Now
</a>

</div>

<?php } ?>

</div>

<script>
function toggleMenu(){
let menu=document.getElementById("dropdown");
menu.style.display = (menu.style.display=="block") ? "none" : "block";
}

function liveSearch(){

let val=document.getElementById("search").value;

fetch("search.php?search="+val)
.then(res=>res.text())
.then(data=>{
document.querySelector(".products").innerHTML=data;
});
}
</script>


</body>
</html>