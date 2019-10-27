<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Create a project</title>
<link rel="stylesheet" href="styles1new.css">

</head>
<body>
<div class="header">
	<h2>Create a new project</h2>
</div>
<form method="post" action="project.php">
	<div class="input-group" style="margin-top:60px;">
		<label>Project Name</label>
		<input type="text" name="pname" value="" autocomplete="off">
	</div>
	<div class="input-group">
		<label>admin id</label>
		<?php echo ucfirst($_SESSION['user']['id']); ?>
	</div>
	<div class="input-group">
		<label>Description</label>
		<input type="text" name="disc" value="" autocomplete="off">
	</div>
    <div class="input-group">
		<label style="align:left">Enter User_Id's:</label>
	</div>
	<div class="input-group">
		<label>User 1</label>
		<input type="text" name="id_user1" value="" autocomplete="off">
	</div>
	<div class="input-group">
		<label>User 2</label>
		<input type="text" name="id_user2" value="" autocomplete="off">
	</div>
	<div class="input-group">
		<label>User 3</label>
		<input type="text" name="id_user3" value="" autocomplete="off">
	</div>

	<div class="input-group">
		<button type="submit" class="btn" name="create_proj_btn">Create</button>
	</div>
	<a align='center' style="background-color: white; width:200px; color: black; text-decoration: none;" class="btn" name="create_proj_btn" href='../login/index.php'>USER-DASHBOARD</a>
</form>
</body>
</html>

