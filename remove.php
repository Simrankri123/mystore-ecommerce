<?php
include "connect.php";

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM cart WHERE id='$id'");

header("location:cart.php");
?>