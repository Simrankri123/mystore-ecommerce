<?php
include "connect.php";

$id=$_POST['id'];
$action=$_POST['action'];

$res=mysqli_query($conn,"SELECT * FROM cart WHERE id='$id'");
$data=mysqli_fetch_assoc($res);

$q=$data['quantity'];
$user_id=$data['user_id'];

if($action=="inc"){
$q++;
}else if($action=="dec" && $q>1){
$q--;
}

mysqli_query($conn,"UPDATE cart SET quantity='$q' WHERE id='$id'");

// new total calculate
$totalRes=mysqli_query($conn,
"SELECT products.price, cart.quantity 
FROM cart 
JOIN products ON cart.product_id=products.id
WHERE cart.user_id='$user_id'");

$total=0;

while($row=mysqli_fetch_assoc($totalRes)){
$total += $row['price'] * $row['quantity'];
}

// return JSON
echo json_encode([
"qty"=>$q,
"total"=>$total
]);
?>