<?php

//fetch_comment.php
session_start();

$username= $_SESSION['user']['username'];

    if(isset($_SESSION['pid']))
    {
        $pid = $_SESSION['pid'];
    }
else{
    $pid = -1;
}

$connect = new PDO('mysql:host=localhost;dbname=multi_login', 'root', '');

$query = "
SELECT * FROM comment WHERE reply_comment_id = '0' AND pid=$pid ORDER BY comment_id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($connect, $row["comment_id"], $pid);
}

echo $output;

function get_reply_comment($connect, $parent_id, $pid, $marginleft = 0)
{
 $query = "
 SELECT * FROM comment WHERE reply_comment_id = '".$parent_id." ' AND pid= $pid";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["reply_comment_id"].' ORDER BY comment_id DESC">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["reply_comment_id"], $marginleft);
  }
 }
 return $output;
}

?>