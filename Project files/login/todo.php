<?php
    $errors="";


$db_todo = mysqli_connect('localhost','root','','todo');

if(isset($_POST['submit'])){
    $task=$_POST['task'];
    $pid = $_GET['data'];
    if(empty($task)){
        $errors="You must fill in a task";
    }else {
        mysqli_query($db_todo, "INSERT INTO tasks (pid, task) VALUES ($pid,'$task')");
        header('location: index.php');
    }
}

    if(isset($_GET['del_task'])){
        $id=$_GET['del_task'];
        mysqli_query($db_todo,"DELETE FROM tasks WHERE tid= $id");
        header('location: index.php');
    }
    else{
        die("<h2 align='center'><font color='red'><a href='../login/index.php'>Please enter a task!!</a></font></h2>");
    }

    
?>