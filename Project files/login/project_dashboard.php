<?php
include('functions.php');

?>
<?php
    if(isset($_GET["data"]))
    {
        $data = $_GET["data"];

    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="header">
		<h2>PROJECT DASHBORD</h2>
	</div>
	<div class="content">
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
			

			<div>
				<p>Project Admin</p>
						<?php echo $_SESSION['user']['username']; ?>
					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<p>User Id - <?php echo ucfirst($_SESSION['user']['id']); ?></p>
						<br>

				<?php  if (isset($_SESSION['user'])) : ?>
					
					<small>
						
						
						<?php 
							error_reporting(0);

								$sql="SELECT pname,disc,pid FROM members_project where pid=$data ";
								if ($result=mysqli_query($db, $sql))
								  {
								  // Fetch one and one row
								  while ($row=mysqli_fetch_row($result))
								    {
								    echo "Project Name ";
								    echo "<br>";
								    printf ("%s\n",$row[0],$row[1]);
								    echo "<br>";
								    echo "<br>";
								    echo "Project Description ";							
								    echo "<br>";
								    printf ("%s\n",$row[1],$row[2]);
								    echo "<br>";
								    echo "<br>";

								    echo "Upload a file ";
								    }
								  // Free result set
								  mysqli_free_result($result);
								}						
						?>
						<br>
						<br>
				<form action="../folder/upload.php" method="post" enctype="multipart/form-data">
			        <label>Document Name</label>
			        <input type="tex" name="doc_name">
			        <br>
			        <span hidden="true">
			        <label>PID</label>
			        <input type="tex" name="pid" value="<?php echo $data ;?>" readonly>
			        </span>
			     
			        <input type="file" name="myfile">
			        <input type="submit" name="submit" value="Upload">
				</form>

    			<br>
				<p>Files</p>
				<br>
				<?php
include('../folder/inc/db.php');
error_reporting(0);
$sql = "SELECT * FROM documents where pid=$data";
$con = mysqli_connect('localhost',$user,$pass,'folder') or die($error);
$res = mysqli_query($con,$sql);
?> 

<?php
echo  "fid timestamp file name ";
    while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        $fid = $row['fid'];
        $name = $row['name'];
        $path = $row['path'];
        $timestamp = $row['timestamp'];
        echo $fid." ".$timestamp." ".$name."<a href='../folder/download.php?dow=$path'>Download</a>";
        echo "<br>";
    }
    ?>

				<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>
