<?php

$user = 'root';
$pass = '';
$db='folder';
$error = "error";
$con = mysqli_connect('localhost',$user,$pass) or die($error);
mysqli_select_db($con,$db) or die($error);

?>