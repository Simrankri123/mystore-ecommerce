<?php
$conn = mysqli_connect("localhost","root","","mystore");

if(!$conn){
die("Connection Failed");
}

session_start();
?>