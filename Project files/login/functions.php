<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'multi_login');
// variable declaration
$username = "";
$email    = "";
$errors   = array(); 
$pid ="";
// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}



// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);
			
			$_SESSION['user'] = getUserById($logged_in_user_id); 
						
			
						
			// put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id= $id";
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}


// return projects by id
function getProjectById($id){
	global $db;
	$query = "SELECT pname FROM members_project WHERE admin_id= $id ";
	$result = mysqli_query($db, $query);

	$padmin = mysqli_fetch_assoc($result);
	return $padmin;
}


// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}



// call the  function if creat_proj_btn is clicked
if (isset($_POST['create_proj_btn'])) {
	create_proj();
}

function create_proj(){
global $db, $errors;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$pname    =  e($_POST['pname']);
	$admin_id  =  e($_SESSION['user']['id']);
	$user_id1  =  e($_POST['id_user1']);
	$user_id2  =  e($_POST['id_user2']);
	$user_id3  =  e($_POST['id_user3']);
	$disc  =  e($_POST['disc']);

if (empty($pname)) { 
		array_push($errors, "Project name is required"); 
	}
	
    $check_presence_userid = "SELECT id FROM users WHERE id = '$user_id1' or id = '$user_id1' or id = '$user_id1'";
    $res = mysqli_query($db, $check_presence_userid);
    $count = mysqli_num_rows($res);
	// register user if there are no errors in the form
    if($count>0)
        if (count($errors) == 0) {

            $query = "INSERT INTO members_project (admin_id,pname,disc, user_id1, user_id2, user_id3) 
                          VALUES('$admin_id','$pname','$disc', '$user_id1', '$user_id2', '$user_id3')";
                mysqli_query($db, $query);
                header('location: index.php');				

        }
    else{
        $message = "UserId doesn't exits!!";
        echo "$message"; 
        print_r($message);
        echo "<script type='text/javascript'>alert('$message');</script>"; 
    }
	
}

?>						