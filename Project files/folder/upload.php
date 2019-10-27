<?php
include('inc/db.php');
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);

if(isset($_POST['submit'])){
    if(isset($_GET["data"]))
    {
        $data = $_GET["data"];
    }
    $doc_name = $_POST['doc_name'];
    $pid = $_POST['pid'];
    $name = $_FILES['myfile']['name'];
    $fileType = $_FILES['myfile']['type'];
    $tmp_name = $_FILES['myfile']['tmp_name'];
    $fileExt = explode('.',$name);
    $afileExt = strtolower(end($fileExt));
    
    $check_duplicate_fname = "SELECT name FROM documents WHERE name = '$doc_name'";
    $res = mysqli_query($con, $check_duplicate_fname);
    $count = mysqli_num_rows($res);
    
    if($count>0){
        echo "<h2 align='center'><font color='red'><a href='../login/index.php'>Please change the File_name</a></font></h2>";
    }
    else{
        if($name && $doc_name) {

            $Location = "documents/$doc_name.$afileExt";
            move_uploaded_file($tmp_name,$Location);
            $query = mysqli_query($con,"INSERT INTO documents (pid,type,name,path) VALUES ('$pid','$afileExt','$doc_name','$Location')");
            //echo $data;'
            header("Location:../login/index.php");

        } else {
            die("<h2 align='center'><font color='red'><a href='../login/index.php'>Please select a file!!</a></font></h2>");
        }
    }
}

?>

