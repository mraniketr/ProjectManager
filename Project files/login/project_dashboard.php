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
				

				<?php  if (isset($_SESSION['user'])) : ?>
					
					<small>
						
						
						<?php 
							error_reporting(0);

								$sql="SELECT pname,disc FROM members_project WHERE pid= 13 ";
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

								    }
								  // Free result set
								  mysqli_free_result($result);
								}						
						?>
						<br>
						<p>Project Admin</p>
						<?php echo $_SESSION['user']['username']; ?>
		<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<p>User Id - <?php echo ucfirst($_SESSION['user']['id']); ?></p>
						<br>
						<p>Files</p>
						<br>
						<a href="project.php" style="color: green;">Upload a File</a>
						<br>

						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>
