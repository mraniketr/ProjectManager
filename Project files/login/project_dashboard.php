<?php
include('functions.php');

?>
<?php
    if(isset($_GET["data"]))
    {
        $data = $_GET["data"];
        $_SESSION['pid'] = $data;

    }
$db= mysqli_connect('localhost','root','','multi_login');
$db_todo= mysqli_connect('localhost','root','','todo');

$tasks=mysqli_query($db_todo, "SELECT * FROM tasks WHERE pid= $data ORDER BY tid ASC");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="styles1new.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
		table {
border-collapse: collapse;
width: 90%;
color: #588c7e;
text-align: center;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}

	</style>
    <meta charset="utf-8">
</head>
<body>
    <div class = "dhaval">
	<div class="header">
    <h2>PROJECT DASHBOARD</h2>
	</div>
	<div class="content">
        <div class  = "sahil">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			

			<div class="details">
				<p >Project Admin</p>
						<?php echo $_SESSION['user']['username']; ?>
					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<p>User Id - <?php echo ucfirst($_SESSION['user']['id']); ?></p>
						<br>

				<?php  if (isset($_SESSION['user'])) : ?>
					<p >Project Name</p>
					<small>
						
						<?php 
							error_reporting(0);

								$sql="SELECT pname,disc,pid FROM members_project where pid=$data ";
								if ($result=mysqli_query($db, $sql))
								  {
								  // Fetch one and one row
								  while ($row=mysqli_fetch_row($result))
								    {
								    
								    printf ("%s\n",$row[0],$row[1]);
								    echo "<br>";
								    echo "<br>";
								    echo "<p>Project Description</p> ";							
								    printf ("%s\n",$row[1],$row[2]);
								    echo "<br>";
								    echo "<br>";

								    echo "<p>Upload a file</p>";
								    }
								  // Free result set
								  mysqli_free_result($result);
								}						
						?>
        <form action="../folder/upload.php" method="post" enctype="multipart/form-data">
            <input type="text" name="doc_name" autocomplete="off">
            <br>
            <span hidden="true">
            <label>PID</label>
            <input type="text" name="pid" value="<?php echo $data ;?>" readonly>
            </span>

            <input type="file" name="myfile">
            <input type="submit" name="submit" value="Upload">
        </form>
        <br>
				<p>Files</p>
				<?php
include('../folder/inc/db.php');
error_reporting(0);
$sql = "SELECT * FROM documents where pid=$data";
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);
$res = mysqli_query($con,$sql);
?> 

<div id="table-wrappers">
<div id="table-scrolls">
<table>
<tr>
<th align='center'>NAME</th>
<th align='center'>TYPE</th>
<th align='center'>LOG</th>
<th align='center'>DOWNLAOD</th>
<th align='center'>DELETE</th>
</tr>
<?php
    while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        $fid = $row['fid'];
        $name = $row['name'];
        $path = $row['path'];
        // echo $fid." ".$timestamp." ".$name."<a href='../folder/download.php?dow=$path'>Download</a>";
     	echo "<tr><td align='left'>".$row['name']."</td><td align='left'>". $row['type']."</td><td align='left'>". $row['timestamp']."</td><td align='left'>"."<a href='../folder/download.php?dow=$path'>Download</a>"."</td><td align='left'>"."<a href='../folder/delete.php?del=$path'>Delete</a>"."</td></td></tr>";
    }
 echo "</table>";
    ?>
</table>
</div>
</div>
<p>UPDATE A FILE</p>
<form action="../folder/update.php" method="post" enctype="multipart/form-data">
        <input type="text" name="doc_name" autocomplete="off">
        <br>
        <span hidden="true">
        <label>PID</label>
        <input type="text" name="pid" value="<?php echo $data ;?>" readonly>
        </span>

        <input type="file" name="myfile">
        <input type="submit" name="submit" value="Update to Filename">
    </form>                 
<div>
        <p>To-do List</p>
    
    <form method="POST" action="todo.php?data=<?php echo $data; ?>">
        <?php if(isset($errors))?>
            <p></p>
        <input type="text" name="task" class="task_input">
        <button  type="submit" class="add_btn" name="submit">Add task</button>
    </form>
    <div id="table-wrapper">
  <div id="table-scroll">
    <table style="border-collapse: collapse; border-spacing: 0; width: 100%;  border: 1px solid #ddd; height:100px; overflow-y:scroll">
        <thead>
            <tr>
                <th align="left">No.</th>
                <th align="left">Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody style="overflow-y:auto; height:76px;">
        <?php $a="#FFFFFF";$i=1; while ($row=mysqli_fetch_array($tasks)){?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['task'];?></td>
                <td>
                    <a href="todo.php?del_task=<?php echo $row['tid']; ?>">x</a>
                </td>
            </tr>
        <?php $i++; } ?>
        </tbody>
    </table>
        </div>
    </div>
</div>
                        
<div>
      <br>
  <p>Comment System</p>
  <div class="container" style="margin-top:50px">
   <form method="POST" id="comment_form">
<!--    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>-->
    <div class="form-group">
     <textarea name="comment_content" style="width: 600px; height:200px" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group" style="background: white">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br>
   <p>Comments</p>
   <div style="height:200px; width:1090px; overflow:auto; background-color:grey; scrollbar-base-color:gold; font-family:sans-serif;padding:10px; " id="display_comment"></div>
  </div>
</div>
            

				<br>
						<a style="width:300px; margin-left:462px;" href='../login/index.php'>USER-DASHBOARD</a>
                        <a style="width:200px; margin-left:515px;"  class="red2" href="index.php?logout='1'" style="color: white;">LOGOUT</a>
                    
					</small>

				<?php endif ?>
                </div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"../comment/add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"../comment/fetch_comment.php",
    
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
 
});
</script>
    </body>
</html>