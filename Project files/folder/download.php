<?php

include('inc/db.php');
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);
if(isset($_GET['dow'])) {
    $path = $_GET['dow'];
    $res = mysqli_query($con,"SELECT (name) FROM documents WHERE path='$path' and id=$id");
    
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($path).'"');
    header('Content-Length: '.filesize($path));
    readfile($path);
}

?>