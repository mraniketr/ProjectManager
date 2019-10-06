<?php
    if(isset($_GET["data"]))
    {
        $data = $_GET["data"];

    }
?>
<?php
include('inc/db.php');
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);
 echo $data;
if(isset($_POST['submit'])){
    
    $doc_name = $_POST['doc_name'];
    $pid = $_POST['pid'];
    $name = $_FILES['myfile']['name'];
    $tmp_name = $_FILES['myfile']['tmp_name'];
    
    if($name && $doc_name) {

        $Location = "documents/$name";
        move_uploaded_file($tmp_name,$Location);
        $query = mysqli_query($con,"INSERT INTO documents (pid,name,path) VALUES ('$pid','$doc_name','$Location')");

        header("Location:../login/index.php");
        
    } else {
        die("Please select a file");
    }

}

?>

