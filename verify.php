<?php

if(isset($_GET['vkey'])){

$vkey = $_GET['vkey'];
$db = mysqli_connect('localhost', 'root', '', 'registration1');

$resultSet = $db->query("SELECT verified,vkey FROM users WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");

if($resultSet->num_rows == 1){

$update = $db->query("UPDATE users SET verified = 1 WHERE vkey = '$vkey' Limit 1");
if($update){echo "You may now log in";}
else{echo "error";}

}else{echo "This account is invalid";}

}else{
    die("Something went wrong");
}

?>




<html>
<head>
<link href="style3.css" rel="stylesheet" type="text/css" />
</head>
</html>