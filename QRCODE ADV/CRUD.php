<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrdatabase";


$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}

       if(isset($_POST['submit'])){
          $Name=$_POST['tName'];
          $Grade=$_POST['Grade'];
          $Section=$_POST['Section'];
          $Student_ID=$_POST['STUDENTID'];
          $Number=$_POST['CONTACT'];
          $date = date('Y-m-d');

           $sql = mysqli_query($conn, "INSERT INTO record(tName, Grade, Section, STUDENTID, CONTACT, DateCreated) VALUES ('$Name', '$Grade', '$Section', '$Student_ID', '$Number', '$date')");

           if($sql){
            echo "<script>alert('New Record Successfully Added!');</script>";
            echo "<script>document.location='Connect.php';</script>";
            }else{
            echo "<script>alert('Something went wrong');</script>";
           }
    }   

?>
<!DOCTYPE html>

<html>
    <head>

    <title>StudentRecords</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    
    </head>
    <body>
    
    <div class="container" style="width:50%">
        <div class="row">
          <div class="col-md-6">
            <h2>Registered Students</h2>
          </div>
        </div>
        <form method="POST">
            <div class="row">
              <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="tName" class="form-control" placeholder="Enter Name of Student" required>
              </div>
              <div class="col-md-6">
                <label>Grade</label>
                <input type="text" name="Grade" class="form-control" placeholder="Enter Grade Level of Student" required>
              </div>
              <div class="col-md-6">
                <label>Section</label>
                <input type="text" name="Section" class="form-control" placeholder="Enter Section of Student" required>
              </div>
              <div class="col-md-6">
                <label>Student ID</label>
                <input type="text" name="STUDENTID" class="form-control" placeholder="Enter ID of Student" required>
              </div>
              <div class="col-md-6">
                <label>Contact Number</label>
                <input type="text" name="CONTACT" class="form-control" placeholder="Enter Contact# of Student" required>
              </div>
            </div>
            <div class="col-md-6" style="margin-top:1%"> 
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <a href="Records.php" class="btn btn-success">View Record</a>
              </div>
    </div>
    </body>
</html>