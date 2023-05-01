 <!DOCTYPE html>
 <?php session_start();
  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 
 ?>
<html lang="en">
  <head>
  <meta name="viewport"  content="width-device-width, initial-scale=1">
  <title>Instascan</title>

  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script type="text/javascript" script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/8.2.2/adapter.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
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
 <body  style="background-image: url('pxfuel.com.jpg')">
 <div class="topnav" id="thetopnav">
  <a href="Home.php">Home</a>
  <a href="#Camera" class="active">SCAN</a>
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
  <a href="javascript:void(0);" style="font: size 15px;" class="icon" onclick="myfunction()">&#9776;</a>
</div>
    <div class="container">
        <div class="row">
          <div class="col-md-6" style="margin-top:30px;padding:10px;background:#fff;border-radius: 5px;background-color:darkslategrey">
          <center><p class="login-box-msg"> <i class="glyphicon glyphicon-camera"></i> TAP HERE</p></center>
             <video id="preview" width="100%"></video>
             <?php
             if(isset($_SESSION['error'])){
               echo "
                <div class='alert alert-danger'>
                 <h4>Error!</h4>
                   ".$_SESSION['error']."
                   </div>
                  ";
                  echo "<script>
                  var audio = new Audio('error.m4a');
                  audio.play();
              </script>";
               unset($_SESSION['error']); 
                  }
               if(isset($_SESSION['success'])){
               echo "
              <div class='alert alert-success' style='background:navy;color:white'>
             <h4>Success!</h4>
              ".$_SESSION['success']."
              
               </div>
              ";
              echo "<script>
              var audio = new Audio('Success.mp3');
              audio.play();
          </script>";
          

    unset($_SESSION['success']); 
  }
             
             ?>
          </div>
          <div class="col-md-6">
          <form action="Insert1.php" method="post" form="form-horizontal">
            <label>SCAN QR CODE</label>
            <input type="text" name="text" id="text" readonny="" placeholder="SCAN QRCODE" class="form-control">
            </form>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td>Name</td>
                  <td>STUDENT ID</td>
                  <td>TIME-IN</td>
                  <td>TIME-OUT</td>
                  <td>LOGDATE</td>
                  <td>STATUS</td>

                </tr>
              </thead>
              <tbody>
                <?php
                 $server = "localhost";
                 $username = "root";
                 $password = "";
                 $dbname = "qrdatabase";
             
                 $conn = new mysqli($server,$username,$password,$dbname);
                
                 if($conn->connect_error){
                     die("Connection failed" .$conn->connect_error);
                 }

                 $sql ="SELECT Name,STUDENTID,TIMEIN,TIMEOUT,LOGDATE,STATUS FROM attendance WHERE LOGDATE = CURDATE()";
                 $query = $conn->query($sql);
                 while ($row = $query->fetch_assoc()){


                 
                ?>
                <tr>
                  <td><?php echo $row['Name'];   ?></td>
                  <td><?php echo $row['STUDENTID'] ;  ?></td>
                  <td><?php echo $row['TIMEIN'] ;  ?></td>
                  <td><?php echo $row['TIMEOUT'] ;  ?></td>
                  <td><?php echo $row['LOGDATE']  ; ?></td>
                  <td><?php echo $row['STATUS']   ;?></td>
                </tr>
                <?php
                 }
                 ?>
              </tbody>

            </table>
         </div>
       </div>
    </div>
  
    <script>
         let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
         Instascan.Camera.getCameras().then(function (cameras) {
         if (cameras.length > 0) {
         scanner.start(cameras[0]);
         } else {
         alert('No cameras found.');
         }
         }).catch(function (e) {
         console.error(e);
         });
          scanner.addListener('scan' ,function(c){
             document.getElementById('text').value=c;
             document.forms[0].submit();  
         });

         function myfunction(){
          var x =document.getElementById("thetopnav");
          if(x.className ==="topnav"){
            x.className +="responsive";
          }else{
            x.className = "topnav";
          }
         }
      </script>
    </script>
  </body>
</html>
<?php 
}else {
   header("Location: login.php");
}
 ?>