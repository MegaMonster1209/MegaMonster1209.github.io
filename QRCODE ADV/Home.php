<?php 
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<style> 
   body{
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
   }
   .square {
  height: 50px;
  width: 50px;
  background-color: #555;
}
   .topnav{
    overflow: hidden;
    background-color:darkorange;
   }
   .topnav a{
    float:left;
    display: block;
    color:aliceblue;
    text-align: center;
    padding: 14px 16px ;
    text-decoration: none;
    font-size: 18px;
   }
   .active{
    background-color:darkblue;
    color:white;

   }
   .topnav .icon{
    display: none;

   }
   .dropdown{
    float: left;
    overflow: hidden;
   }
   .dropdown .dropbtn{
    font-size: 18px;
    border: none;
    outline: none;
    color: white ;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
   }
   .dropdown-content{
   display: none;
   position:fixed;
   background-color: white;
    box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.5);
    z-index: 1;
   }
   .dropdown-content a{
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
   }
   .topnav a:hover .dropdown:hover .dropbtn{
    background-color:dodgerblue;
    color: white;

   }
   .dropdown:hover .dropdown-content{
    display: block;
   }
   @media screen and (max-width:600px) {
    .topnav.responsive{position: relative;}
    .topnav.responsive .icon{
      position:absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive a{
      float: none;
      display: block;
      text-align: left;
    }
    .topnav.responsive .dropdown{float: none;}
    .topnav.responsive .dropdown-content{position: relative;}
    .topnav.responsive .dropdown .dropbtn{
      display: block;
      width: 100%;
      text-align: left;
    }
   }
   @media screen and (max-width:600px) {
    .topnav a:not(:first-child), .dropdown .dropbtn{
      display: none;
    }
    .topnav a.icon {  
      float: right;
      display: block;
    }
   }
   </style>
<body  style="background-image: url('pxfuel.com.jpg')">
<div class="topnav" id="thetopnav">
       <a href="Home.php" class="active">Home</a>
       <a href="index.php">SCAN</a>
        <a href="Records.php">Student Records</a>
        <a href="Sort.php">Log Records</a>
        <div class="dropdown">
          <button class="dropbtn">More
          <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
          <a href="#">link 1</a>
          <a href="#">link 2</a>
             <a href="#">link 3</a>
        </div>
  </div>
  <a href="#about">About</a>
  
</div>
	 <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
	 
	 	<i class="bi bi-person-fill" style="font-size: 14rem;background-color:aliceblue"></i>
        <h1 class="text-center display-4" style="margin-top: -60px;font-size: 2rem"><?=$_SESSION['user_full_name']?></h1>
        <a href="logout.php" class="btn btn-warning">LOGOUT</a>
	 
	 </div>
</body>
</html>
<?php 
}else {
   header("Location: login.php");
}
 ?>
