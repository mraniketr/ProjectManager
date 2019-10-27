<?php
include('functions.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="styles2.css">
</head>
<body>
	<div class="header">
		<h2>USER DASHBORD</h2>
	</div>
	<div class="content" id="pd1">
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
			

			<div style="margin-top:-400px">
				<?php  if (isset($_SESSION['user'])) : ?>
                <h2 style="font-size:40px;">USER DETAILS</h2>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<h3>User Id - <?php echo ucfirst($_SESSION['user']['id']); ?></h3>
						<?php $id=$_SESSION['user']['id'] ?>
						<br>
						<h2 class="paddingh2" style="font-size:40px;"> Admin Projects</h2>
                        <div style="height:80px; width:auto; overflow:auto; background-color:aliceblue; scrollbar-base-color:gold; padding:10px; ">
						<?php 
							error_reporting(0);

								$sql="SELECT pname,pid FROM members_project WHERE admin_id= $id ";
								if ($result=mysqli_query($db, $sql))
								  {
								  // Fetch one and one row
								  while ($row=mysqli_fetch_row($result))
								    {
								    // printf ("%s\n",$row[0],$row[1]);
								    echo "<a href='../login/project_dashboard.php?data=$row[1]'>$row[0]</a>";
								    //echo "<br>";
								    
								    }
								  // Free result set
								  mysqli_free_result($result);
								}						
						?>
                        </div>    
						<br>
						<h2 class="paddingh2" style="font-size:40px;"> Other Projects</h2>
                        <div style="height:150px; width:auto; overflow:auto; background-color:aliceblue; scrollbar-base-color:gold; padding:10px; ">
							<?php 
							error_reporting(0);

								$sql="SELECT pname,pid FROM members_project WHERE user_id1= $id or user_id2= $id or user_id3= $id";
								if ($result=mysqli_query($db, $sql))
								  {
								  // Fetch one and one row
								  while ($row=mysqli_fetch_row($result))
								    {
								    // printf ("%s\n",$row[0],$row[1]);
								    echo "<a href='../login/project_dashboard.php?data=$row[1]'>$row[0]</a>";
								    }
								  // Free result set
								  mysqli_free_result($result);
								}						
						?>
                        </div>
						<br>
						<a class="green" href="project.php" style="color: white;">CREATE NEW PROJECT</a>
						<br>

						<a class="red" href="index.php?logout='1'" style="color: white;">LOGOUT</a>
					</small>

				<?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>
