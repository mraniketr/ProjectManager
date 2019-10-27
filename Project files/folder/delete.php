<?php

include('inc/db.php');
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);

if(isset($_GET['del'])) {
    $path = $_GET['del'];
    $res = mysqli_query($con,"DELETE FROM documents WHERE path='$path'");
    
    unlink($path);
    
    header("Location:../login/index.php");
}

?>

