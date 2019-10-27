<?php
include('inc/db.php');
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);

if(isset($_POST['submit'])){
    
    $doc_name = $_POST['doc_name'];
    $name = $_FILES['myfile']['name'];
    $tmp_name = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExt = explode('.',$name);
    $afileExt = strtolower(end($fileExt));
    
     $check_duplicate_fname = "SELECT name FROM documents WHERE name = '$doc_name'";
    $res = mysqli_query($con, $check_duplicate_fname);
    $count = mysqli_num_rows($res);
    
    if($count == 0){
        echo "<h2 align='center'><font color='red'><a href='../login/index.php'>File doesn't exist!!!</a></font></h2>";
    }
    else{
        if($name && $doc_name) {
                $Location = "documents/$doc_name.$afileExt";
            $old_path = mysqli_query($con,"SELECT * FROM documents WHERE name = '$doc_name'");
            while($row = mysqli_fetch_array($old_path,MYSQLI_ASSOC)) {
                $o_path = $row['path'];
            }
             //echo $o_path;
             unlink($o_path); 
             move_uploaded_file($tmp_name,$Location);
             //$time = date('Y-m-d H:i:s');
             $query = mysqli_query($con,"UPDATE documents SET type = '$afileExt', path = '$Location', timestamp = CURRENT_TIMESTAMP() WHERE name='$doc_name';");

             header("Location:../login/index.php");
            }
        else {
            die("<h2 align='center'><font color='red'><a href='../login/index.php'>Please select a file!!</a></font></h2>");
        }
    }
}
    //header("Location:../login/index.php");
?>