<?php include('functions.php') ?>
<form method="post" action="register.php">
	<?php echo display_error(); ?>
<input type="text" name="username" value="<?php echo $username; ?>">
<input type="email" name="email" value="<?php echo $email; ?>">

</form>



<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
<link rel="stylesheet" href="styles1new.css">

</head>
<body>
<div class="header">
	<h2>Register</h2>
</div>
<form method="post" action="register.php">
	<div class="input-group" style="margin-top:60px;">
		<label>Username</label>
		<input type="text" name="username" value="">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>
