<?php
session_start();
$username = "";
$email    = "";

$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'registration1');
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
    if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
if (count($errors) == 0) {

    $vkey = md5(time().$username); 
  	$password = md5($password_1);
  	$query = "INSERT INTO users (username, email, `password`,vkey) 
  			  VALUES('$username', '$email', '$password','$vkey')";
    mysqli_query($db, $query);
    

  if($query){
    $to = $email;
    $subject = "Email verification";
    $message = "<a href='http://localhost/folder/verify.php?vkey=$vkey'>Register Account</a>";
    $headers = "From: rafiimam96@gmail.com \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

    mail($to,$subject,$message,$headers);

    header('location:thankyou.php');
  }else{echo $db->$errors;}


  	//$_SESSION['username'] = $username;
  	//$_SESSION['success'] = "You are now logged in";
  	//header('location: index.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
 <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
<label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
</div>
<div class="input-group">
  	  <label>Password</label>
 <input type="password" name="password_1">
 </div>
<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
</div>
<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
</div>
  	<p>
	Already a member? <a href="login.php">Sign in</a>
</p>
</form>
</body>
</html>