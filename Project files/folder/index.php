<?php
include('inc/db.php');
error_reporting(0);
$sql = "SELECT * FROM documents";
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);
$res = mysqli_query($con,$sql);
?> 

<html>
<head>
<title>FILE-UPLOAD-DOWNLOAD</title>
</head>
<body>
    
    <br>
    <?php
    while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        $id = $row['id'];
        $name = $row['name'];
        $path = $row['path'];
    
        echo $id."".$name."<a href='download.php?dow=$path'>Download</a>";
        echo "<br>";
    }
    ?>
</body>
</html>