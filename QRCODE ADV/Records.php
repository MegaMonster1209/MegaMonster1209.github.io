<?php session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "qrdatabase";
$conn = new mysqli($server,$username,$password,$dbname);

if($conn->connect_error){
   die("Connection failed" .$conn->connect_error);
}

if(isset($_GET['delid'])){
  $id=intval($_GET['delid']);
  $sql =mysqli_query($conn,"DELETE FROM record WHERE id='$id'");
  echo"<script>alert('Record has been successfully deleted!');</script>";
  echo"<script>window.location='Records.php'</script>";
}

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 
 ?>
<html>
    <head>
 
    <title>StudentRecords</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        $("#myInput").on("keyup",function(){
          var value =$(this).val().toLowerCase( );
          $("#myTable tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          })

        })
      })
    </script>
    <style> 
   body{
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
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
    </head>
    <body style="background-image: url('pxfuel.com.jpg')">
    <div class="topnav" id="thetopnav">
       <a href="Home.php">Home</a>
       <a href="index.php">SCAN</a>
        <a href="Records.php" class="active">Student Records</a>
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
  <a href="javascript:void(0);" style="font: size 15px;" class="icon" onclick="myfunction()">&#9776;</a>
</div>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="background-color:rgba(0, 27, 50, 100);color:aliceblue;margin-top: 20px">
                    <h3>List of Students</h3>
                    <div class="col-md-6">
                <div class="form-group"> <input type="text" id="myInput" placeholder="Search..." class="form-control"></div>
              </div>
                    <button type="submit" class="btn btn-success" onClick = "Export()">
                    Export to Excel</button>
                    
                   
                    <a href="QR.php" class="btn btn-warning pull-right" style="background-color:green;border-color:green"><span class="glyphicon glyphicon-qrcode"></span>Generate QR Code</a>
                    <a href="CRUD.php" class="btn btn-warning pull-right" style="margin-right: 10px;"><span class="glyphicon glyphicon-plus"></span>Register New Student</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-18">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="background-color:lightsteelblue">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Grade</th>
                                <th>Section</th>
                                <th>Student ID</th>
                                <th>Contact Number</th>
                                <th>Register Date</th>
                                <th>Actions</th>
                            </thead>
                            <tbody id="myTable">
                                <?php
                              
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "qrdatabase";
                                $conn = new mysqli($servername, $username, $password, $dbname); 

                                if(isset($_GET['page_no']) && $_GET['page_no']!=""){
                                  $page_no = $_GET['page_no'];
                                }else{
                                  $page_no = 1;
                                }

                                $total_records_per_page = 20;
                                $offset = ($page_no-1) * $total_records_per_page;
                                $previous_page =  $page_no -1;
                                $next_page = $page_no +1;
                                $adjacents = "2";

                                $result_count=mysqli_query($conn,"SELECT COUNT(*) as total_records FROM record");
                                $total_records = mysqli_fetch_array($result_count);
                                $total_records = $total_records['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                $second_last = $total_no_of_pages - 1;


                                $sql = mysqli_query($conn,"SELECT * FROM record ORDER by Grade LIMIT $offset,$total_records_per_page");
                                $count =1;
                                $row = mysqli_num_rows($sql);
                                if($row > 0){
                                    while($row =mysqli_fetch_array($sql)){
                                        ?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $row['tName'];?></td>
                                            <td><?php echo $row['Grade'];?></td>
                                            <td><?php echo $row['Section'];?></td>
                                            <td><?php echo $row['STUDENTID'];?></td>
                                            <td><?php echo $row['CONTACT'];?></td>
                                            <td><?php echo $row['DateCreated'];?></td>
                                            <td>
                                            <a href="profile.php?id=<?php echo $row['ID'] ?>" class="btn btn-info btn-sm"> <span class="glyphicon glyphicon-user"></span>User profile</a>
                                                <a href="edit.php?editid=<?php echo htmlentities($row['ID'])?>" class="btn btn-warning btn-sm"> <span class="glyphicon glyphicon-pencil"></span>Edit</a>
                                                <a href="Records.php?delid=<?php echo htmlentities($row['ID'])?>" OnClick="return confirm('Are you sure you want to remove this record? This action is permanent and cannot be undone.')" class="btn btn-danger btn-sm"> <span class="glyphicon glyphicon-remove"></span>Remove</a>

                                               
                                                
                                            </td>
                                        </tr>
                                        <?php
                                         $count = $count+1;
                                    }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination pull-right">
                      <li class="pull-left btn  btn-default disabled">Showing page <?php echo $page_no." of " . $total_no_of_pages;?></li>
                      <li <?php if($page_no <=1){echo "class='disabled'";} ?>>
                      <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'";}?>>Previous</a>
                    
                    </li>
                    <?php 
                      if($total_no_of_pages <=20){
                        for($counter = 1; $counter <=$total_no_of_pages;$counter++){
                          if($counter == $page_no){
                            echo "<li class='active'><a>$counter</a></li>";
                          }else{
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                          }
                        }
                      }elseif($total_no_of_pages > 10){
                        if($page_no <=4){
                          for($counter = 1; $counter < 8; $counter++){
                            if($counter == $page_no){
                              echo "<li class='active'><a>$counter</a></li>";
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                          }
                          echo"<li><a>...</a></li>";
                          echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";  
                          echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";  
                        }elseif($page_no > 4 && $page_no < $total_no_of_pages - 4){
                          echo "<li><a href='?page_no=1'>1</a></li>";
                          echo "<li><a href='?page_no=2'>2</a></li>";
                          echo"<li><a>...</a></li>";

                          for($counter = $page_no - $adjacents; $counter <= $page_no  + $adjacents;$counter++){
                            if($counter == $page_no){
                              echo "<li class='active'><a>$counter</a></li>";
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                          }
                          echo"<li><a>...</a></li>";
                          echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";  
                          echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";  
                        }else{
                          echo "<li><a href='?page_no=1'>1</a></li>";
                          echo "<li><a href='?page_no=2'>2</a></li>";
                          echo"<li><a>...</a></li>";
                          for($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages;$counter++){
                            if($counter == $page_no){
                              echo "<li class='active'><a>$counter</a></li>";
                            }else{
                              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                          }
                        }
                      }
                    ?>
                    <li <?php if($page_no > $total_no_of_pages){ echo "class='disabled'";} ?>>
                      <a <?php if($page_no < $total_no_of_pages) {echo "href='?page_no=$next_page'";} ?> >Next</a>
                  
                    </li>
                    <?php if($page_no < $total_no_of_pages) {echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";}  ?>
                    </ul>
        </div>
        <script>
          function Export(){
            var conf = confirm("Export Records to Excel?")
            if(conf ==true){
              window.open("ExportRecords.php",'_blank');
            }
          }
        </script>
    </body>
</html>
<?php
}else {
   header("Location: login.php");
}
 ?>