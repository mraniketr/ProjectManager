<?php
include('functions.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div class="header">
		<h2>USER DASHBORD</h2>
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
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<h3>User Id - <?php echo ucfirst($_SESSION['user']['id']); ?></h3>
						<?php $id=$_SESSION['user']['id'] ?>
						<br>
						<h2> Admin Projects</h2>
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
								    echo "<br>";
								    
								    }
								  // Free result set
								  mysqli_free_result($result);
								}						
						?>
						<br>
						<h2> Other Projects</h2>
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
								    echo "<br>";
								    }
								  // Free result set
								  mysqli_free_result($result);
								}						
						?>
						
						<br>
						<a href="project.php" style="color: green;">Create a project</a>
						<br>

						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>
