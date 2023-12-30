<?php 
session_start();
$username = "";
$email    = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'registration1');
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

if (empty($username)) {
array_push($errors, "Username is required");
}
if (empty($password)) {
array_push($errors, "Password is required");
}

if (count($errors) == 0) {
$password = md5($password);
$query = "SELECT * FROM users WHERE username='$username' AND `password`='$password'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
if ($user) { 

	if(    $user['email'] === "afrinnina49@gmail.com"	)
    {
      $_SESSION['luser'] = $u;

	$_SESSION['start'] = time();

	 // taking now logged in time
	$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ; 
		$_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('Location: index1.php');
    }
    else
    {
      $_SESSION['luser'] = $u;

      $_SESSION['start'] = time();
    
       // taking now logged in time
      $_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ; 
         $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}
else {
array_push($errors, "Wrong username/password combination");
     }
}
} 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system </title>
  <link rel="stylesheet" type="text/css" href="style.css">

<body style=" margin: 0%;
  padding: 0%;
  background-image: url(download.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  font-family: sans-serif;
  height: 100vh;">
  <div class="header">
  	<h2>Login</h2>
  </div>
	 <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
  </body>
</head>
</html>