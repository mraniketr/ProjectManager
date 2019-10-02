<?php
include('inc/db.php');

$sql = "SELECT * FROM documents";
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);
$res = mysqli_query($con,$sql);
?> 

<html>
<head>
<title>FILE-UPLOAD-DOWNLOAD</title>
</head>
<body>
    <a href = "upload.php">Add-New-Document</a>
    <br>
    <?php
    while($row = mysqli_fetch_array($res)) {
        $id = $row['id'];
        $name = $row['name'];
        $path = $row['path'];
    
        echo $id."".$name."<a href='download.php?dow=$path'>Download</a>";
    }
    ?>
</body>
</html>