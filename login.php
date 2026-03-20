<?php include "connect.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="auth-body">

<div class="auth-container">

<h2>Welcome Back 👋</h2>
<p>Login to continue</p>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

<p class="link">
Don't have an account? <a href="register.php">Register</a>
</p>

</div>

</body>
</html>

<?php
if(isset($_POST['login'])){

$email=$_POST['email'];
$password=$_POST['password'];

$res=mysqli_query($conn,
"SELECT * FROM users WHERE email='$email' AND password='$password'");

if(mysqli_num_rows($res)){


$user=mysqli_fetch_assoc($res);
$_SESSION['user_id']=$user['id'];
$_SESSION['user_name']=$user['name'];

header("location:home.php");
header("location:home.php");

}else{
echo "<p style='color:red;text-align:center;'>Invalid Login</p>";
}
}
?>