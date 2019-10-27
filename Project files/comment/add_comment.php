<?php

session_start();
$username= $_SESSION['user']['username'];

    if(isset($_SESSION['pid']))
    {
        $pid = $_SESSION['pid'];
    }
else{
    $pid = -1;
}
//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=multi_login', 'root', '');

$error = '';

$comment_content = '';
$reply_comment_id = '';

if(isset($_SESSION['user']['username']))
{
    $username= $_SESSION['user']['username'];
     $comment_name = $username;

}
else
{
 $error .= '<p class="text-danger">Name is required</p>';
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}


if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is Invalid.</p>';
}
else
{
 $reply_comment_id = $_POST["comment_id"];
}

if($error == '')
{
 $query = "
 INSERT INTO comment (username, comment, reply_comment_id, pid) VALUES(:username, :comment, :reply_comment_id, :pid)";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':username' => $comment_name,
   ':comment'    => $comment_content,
   ':reply_comment_id' => $reply_comment_id,
      ':pid' => $pid
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
