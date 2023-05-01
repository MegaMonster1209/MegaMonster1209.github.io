<?php 
session_start();
include 'db_conn1.php';

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
   header("Location: Home.php");
}

if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
	
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
	$stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
    header("Location: signup.php?error=Email already exists&full_name=$full_name&email=$email");
    exit();
}

	if (empty($full_name)) {
		header("Location: signup.php?error=Full name is required&email=$email");
		exit();
	} else if (empty($email)) {
		header("Location: signup.php?error=Email is required&full_name=$full_name");
		exit();
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: signup.php?error=Invalid email format&full_name=$full_name&email=$email");
		exit();
	} else if (empty($password)) {
		header("Location: signup.php?error=Password is required&full_name=$full_name&email=$email");
		exit();
	} else if ($password !== $confirm_password) {
		header("Location: signup.php?error=Password confirmation does not match&full_name=$full_name&email=$email");
		exit();
	} else {
		// hash password for security
		 $password_hash = password_hash($password, PASSWORD_DEFAULT);
		
		// insert user data into database
		$stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
		$stmt->execute([$full_name, $email, $password_hash]);

		if ($stmt) {
			header("Location: login.php?success=Your account has been created successfully");
		} else {
			header("Location: signup.php?error=Unknown error occurred&full_name=$full_name&email=$email");
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>QR Code Attendance Signup</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<style>
 img {
        float: right;
		margin-right: 250px;
		margin-top: 50px;
		border-radius: 50%;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.5);
        overflow: hidden;
      }
</style>
<body style="background-image: url('pxfuel.com.jpg')">
<img src="logo-placeholder-image.png" >
<?php
  if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger">' . $_GET['error'] . '</div>';
  }

  if (isset($_GET['success'])) {
    echo '<div class="alert alert-success">' . $_GET['success'] . '</div>';
  }
?>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-5">
        <div class="card-header">
          <h4>Signup</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group mb-3">
              <label for="full_name">Full Name</label>
              <input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo isset($_GET['full_name']) ? $_GET['full_name'] : ''; ?>">
            </div>
            <div class="form-group mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
            </div>
            <div class="form-group mb-3">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group mb-3">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" class="form-control" name="confirm_password" id="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
          </form>
        </div>
      </div>
      <div class="mt-3">
        <p>Already have an account? <a href="login.php">Login here</a></p>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-q8i/X+965DZgGnjcTGtb25CqNq3+qOgJto/0pqUW9j8rUbXtWWoSx0TnfdrJwDm+" crossorigin="anonymous"></script>
</body>
</html>