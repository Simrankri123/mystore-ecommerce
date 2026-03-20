<?php include "connect.php"; ?>

<form method="POST">
<h2>Register</h2>

<input type="text" name="name" placeholder="Name" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>

<button name="register">Register</button>
</form>

<?php
if(isset($_POST['register'])){
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];

mysqli_query($conn,
"INSERT INTO users(name,email,password)
VALUES('$name','$email','$password')");

echo "Registered Successfully";
}
?>