<?php

include('inc/db.php');
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);

if(isset($_GET['viw'])) {
    $path = $_GET['viw'];
    $res = mysqli_query($con,"SELECT data FROM documents WHERE path='$path'");
    $datav = $res->fetch();
    header('File-Name':.$row['name']);
}

?>