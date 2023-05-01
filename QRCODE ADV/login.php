<?php 
  session_start();

  if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_email'])) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>QR Code Attendance Login</title>
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
	  <div class="d-flex justify-content-right align-items-right" style="min-height: 100vh;">
	  	<form class="p-5 rounded shadow" 
	  	      action="auth.php"
	  	      method="post" 
	  	      style="width: 30rem;background-color:aliceblue">
	  		<h1 class="text-center pb-5 display-4">LOG-IN</h1>
	  		<?php if (isset($_GET['error'])) { ?>
				
	  		<div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error'])?>
			</div>
		    <?php } ?>
		  <div class="mb-3">
		    <label for="emailinput1" 
		           class="form-label">Email address
		    </label>
		    <input type="email" 
		           name="email" 
		           value="<?php if(isset($_GET['email']))echo(htmlspecialchars($_GET['email'])) ?>" 
		           class="form-control" 
		           id="emailinput1" aria-describedby="emailHelp">
		  </div>
		  <div class="mb-3">
		    <label for="passwordinput1" 
		           class="form-label">Password
		    </label>
		    <input type="password" 
		           class="form-control" 
		           name="password" 
		           id="passwordinput1">
		  </div>
		  <button type="submit" 
		          class="btn btn-primary">LOGIN
		  </button>
          <a href="signup.php" class="ca">Create an account</a>
		</form>
	  </div>
</body>
</html>

<?php 
}else {
   header("Location: Home.php");
}
 ?>
