<!DOCTYPE html>
<?php 
$server = "localhost";
$username = "root";
$password = "";
$dbname = "qrdatabase";
$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
   $userID = $_GET['id'];
   $sql = "SELECT * FROM Record WHERE ID = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $userID);
   $stmt->execute();
   $result = $stmt->get_result();
   $user = $result->fetch_assoc();
} else {
   die("User ID not specified.");
}

?>
<html>
<head>
 <title>User Profile</title> 
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+V9Kg4WdmxXEjVpRV02CxlmI3+UoD6Iw6w0Up/" crossorigin="anonymous">
 <style>
    .card-body {
      background-color:beige;
      padding: 10px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.5);
        overflow: hidden;
    }
  </style>
</head>
<body style="background-image: url('pxfuel.com.jpg')">
<div class="container mt-5">
  <div class="row justify-content-center">
   <div class="col-md-6 mx-auto">
    <div class="card">
     <div class="card-header bg-info text-white">
        <h1 class="text-center">User Profile</h1>
     </div>
     <div class="card-body">
       <?php if (!empty($user)) { ?>
         <ul class="list-group">
          <li>Name: <?php echo $user['tName']; ?></li>
          <li>Grade: <?php echo $user['Grade']; ?></li>
          <li>Section: <?php echo $user['Section']; ?></li>
          <li>Student ID: <?php echo $user['STUDENTID']; ?></li>
          <li>Contact Number: <?php echo $user['CONTACT']; ?></li>
         </ul>
       <?php } else { ?>
        <p>User not found.</p>
        <?php } ?>
         </div>
       </div>
     </div> 
 </div>
</div>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
     integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
     crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper">
     </script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
     integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+V9Kg4WdmxXEjVpRV02CxlmI3+UoD6Iw6w0Up/"
      crossorigin="anonymous"></script>
   </body>
</html>
