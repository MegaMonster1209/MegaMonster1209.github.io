<?php
$con=mysqli_connect('localhost','root','','qrdatabase');
$sub_sql="";
$toDate=$fromDate="";
if(isset($_POST['submit'])){
	$from=$_POST['from'];
	$fromDate=$from;
	$fromArr=explode("/",$from);
	$from=$fromArr['2'].'-'.$fromArr['1'].'-'.$fromArr['0'];
	$from=$from." 00:00:00";
	
	$to=$_POST['to'];
	$toDate=$to;
	$toArr=explode("/",$to);
	$to=$toArr['2'].'-'.$toArr['1'].'-'.$toArr['0'];
	$to=$to." 23:59:59";
	
	$sub_sql= " where LOGDATE >= '$from' && LOGDATE <= '$to' ";
}

$res=mysqli_query($con,"select * from attendance $sub_sql order by id desc");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log Database</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script> $(document).ready(function(){
        $("#myInput").on("keyup",function(){
          var value =$(this).val().toLowerCase( );
          $("#myTable tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          })

        })
      })</script>
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
        <a href="Records.php" >Student Records</a>
        <a href="Sort.php" class="active">Log Records</a>
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
  <br/><h1>Log Records</h1><br/>
  
  <div>
	<form method="post">
		<label for="from">From</label>
		<input type="text" id="from" name="from" required value="<?php echo $fromDate?>">
		<label for="to">to</label>
		<input type="text" id="to" name="to" required value="<?php echo $toDate?>">
		<input type="submit" name="submit" value="Filter">
	</form>
  </div>
  <div class="form-group"> <input type="text" id="myInput" placeholder="Search..." class="form-control"></div>
  <br/><br/>
  <?php if(mysqli_num_rows($res)>0){?>
  <div>
  <table class="table table-bordered" style="background-color:aliceblue">
    <thead>
      <tr>
        <th>Name</th>
        <th>Grade</th>
        <th>Section</th>
        <th>Student ID</th>
        <th>Time-In</th>
		<th>Time-Out</th>
    <th>Log Date</th>
      </tr>
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
      <?php while($row=mysqli_fetch_assoc($res)){?>
      <tr>
        <td><?php echo $row['Name']?></td>
        <td><?php echo $row['Grade']?></td>
        <td><?php echo $row['Section']?></td>
        <td><?php echo $row['STUDENTID']?></td>
		<td><?php echo $row['TIMEIN']?></td>
		<td><?php echo $row['TIMEOUT']?></td>
    <td><?php echo $row['LOGDATE']?></td>
      </tr>
      <?php
                                         $count = $count+1;
                                    }}
                                ?>
	  <?php } ?>
    </tbody>
  </table>
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
                    <?php if($page_no < $total_no_of_pages){ echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo; &rsaquo</li>";}  ?>
                    </ul>
  </div>
  <?php } else {
	echo "No data found";  
  }
  ?>
</div>
<script>
  $( function() {
    var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
		  dateFormat:"dd/mm/yy",
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
		dateFormat:"dd/mm/yy",
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>
</body>
</html>