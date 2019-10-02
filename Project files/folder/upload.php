<?php
include('inc/db.php');
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);
if(isset($_POST['submit'])){
    
    $doc_name = $_POST['doc_name'];
    $name = $_FILES['myfile']['name'];
    $tmp_name = $_FILES['myfile']['tmp_name'];
    
    if($name && $doc_name) {
        $Location = "documents/$name";
        move_uploaded_file($tmp_name,$Location);
        $query = mysqli_query($con,"INSERT INTO documents (name,path) VALUES ('$doc_name','$Location')");
        header("Location:index.php");
        
    } else {
        die("Please select a file");
    }
    
}

?>

<html>
<head>
<title>UPLOAD-DOCUMENTS</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Document Name</label>
        <input type="tex" name="doc_name">
        <input type="file" name="myfile">
        <input type="submit" name="submit" value="Upload">
        
    </form>
</body>
</html>