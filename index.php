<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home Page</title>
	<link rel="stylesheet" href="style2.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    th{ 
        cursor: pointer;
		color:black;
		text size: 200px;
			}
			td{
				cursor: pointer;
		color:white;
		text size: 200px;

			}
</style>
</head>
<body>
<div class="wrapper">
			<nav class="navbar">
				<img class="logo" src="logo.png">
        <ul>
					<li><a class="active" href="index.php">Home</a></li>
					<li><a href="About Us.html">About Us</a></li>
					<li><a href="Contact Us.html">Contact Us</a></li>
					<li><a href="#">Feedback</a></li>
					<?php  if (isset($_SESSION['username'])) : ?>
                    <li><a href="index.php?logout='1'" >logout</a></li>	
    	            <?php endif ?>
        </ul>
			</nav>
	<div class="center">
		<?php if (isset($_SESSION['success'])) : ?>
            <h1>
				<?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
			    ?>
			</h1> 
		<?php endif ?>
                <?php  if (isset($_SESSION['username'])) : ?>
    	    <h2>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2>
		<?php endif ?>
<div class="search_box">
       <form method="post">
                  <input type="text" name="search"placeholder="what are you looking for?">
				  <div class="skills">	
					  <button type="submit" name="submit">Submit</button>
				  </div>
				  
	
		</form>
</div>
					
	<?php
$con = new PDO("mysql:host=localhost;dbname=matlab",'root','');

if (isset($_POST["submit"])) {
	$str = $_POST["search"];
	$sth = $con->prepare("SELECT * FROM `matlab` WHERE `Method` = '$str'");

	$sth->setFetchMode(PDO:: FETCH_OBJ );
	$sth -> execute();

if($row = $sth->fetch())
	{
		?>
		<br><br><br>
		<table class="table table-striped">
			<tr  class="bg-info">
				<th  class="bg-info">Method</th>
				<th>Code</th>
				<th>Type</th>
				<th>Algorithm</th>
			</tr>
			<tr>
				<td><?php echo $row->Method; ?></td>
				<td><?php echo $row->Code;?></td>
				<td><?php echo $row->Type;?></td>
				<td><?php echo $row->Algorithm;?></td>
			</tr>

		</table>
<?php 
	} 
	else{
			echo "Method name Does not exist";
		}
    }
?>
            </div>
	</div>
</body>
</html>