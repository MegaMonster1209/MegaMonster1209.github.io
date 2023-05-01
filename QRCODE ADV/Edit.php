<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrdatabase";


$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}

    if(isset($_POST['update'])){
        $eid =$_GET['editid'];
        $tName=$_POST['tName'];
        $Grade=$_POST['Grade'];
        $Section=$_POST['Section'];
        $STUDENTID=$_POST['STUDENTID'];
        $Number=$_POST['CONTACT'];

        $sql =mysqli_query($conn,"UPDATE record SET tName='$tName', Grade='$Grade', Section='$Section', STUDENTID='$STUDENTID', CONTACT='$Number' WHERE id='$eid'");
        if($sql){
            echo "<script>alert('Record successfully updated!');</script>";
            echo "document.location='Records.php';";
        }else{
            echo "<script>alert('Something went wrong!');</script>";
        }


    }


?>
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
            <h2>Update Student Information</h2>
          </div>
        </div>
        <form method="POST">
            <?php
                $eid =$_GET['editid'];
                $sql=mysqli_query($conn,"SELECT * FROM record WHERE ID='$eid'"); 
                while($row=mysqli_fetch_array($sql)){

                
            ?>
            <div class="row">
              <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="tName" value="<?php echo $row['tName'];?>" class="form-control" placeholder="Enter Name of Student" required>
              </div>
              <div class="col-md-6">
                <label>Grade</label>
                <input type="text" name="Grade" value="<?php echo $row['Grade'];?>" class="form-control" placeholder="Enter Grade Level of Student" required>
              </div>
              <div class="col-md-6">
                <label>Section</label>
                <input type="text" name="Section" value="<?php echo $row['Section'];?>" class="form-control" placeholder="Enter Section of Student" required>
              </div>
              <div class="col-md-6">
                <label>Student ID</label>
                <input type="text" name="STUDENTID" value="<?php echo $row['STUDENTID'];?>" class="form-control" placeholder="Enter ID of Student" required>
              </div>
              <div class="col-md-6">
                <label>Contact Number</label>
                <input type="text" name="CONTACT" value="<?php echo $row['CONTACT'];?>" class="form-control" placeholder="Enter Contact# of Student" required>
              </div>
            </div>
            <?php } ?>
            <div class="col-md-6" style="margin-top:1%"> 
                <button type="text" name="update" class="btn btn-primary">Submit</button>
                <a href="Records.php" class="btn btn-success">View Record</a>
              </div>
    </div>
    </body>
</html>