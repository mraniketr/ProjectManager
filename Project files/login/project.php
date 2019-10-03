<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Create a project</title>
<link rel="stylesheet" href="styles.css">

</head>
<body>
<div class="header">
	<h2>Create a new project</h2>
</div>
<form method="post" action="project.php">
	<div class="input-group">
		<label>Project Name</label>
		<input type="text" name="pname" value="">
	</div>
	<div class="input-group">
		<label>admin id</label>
		<?php echo ucfirst($_SESSION['user']['id']); ?>
	</div>
	<div class="input-group">
		<label>Description</label>
		<input type="text" name="disc" value="">
	</div>
	<div class="input-group">
		<label>User 1</label>
		<input type="text" name="id_user1" value="">
	</div>
	<div class="input-group">
		<label>User 2</label>
		<input type="text" name="id_user2" value="">
	</div>
	<div class="input-group">
		<label>User 3</label>
		<input type="text" name="id_user3" value="">
	</div>

	<div class="input-group">
		<button type="submit" class="btn" name="create_proj_btn">Create</button>
	</div>
	
</form>
</body>
</html>

