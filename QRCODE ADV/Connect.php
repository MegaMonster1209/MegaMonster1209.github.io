<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "qrdatabase";
$conn = new mysqli($server,$username,$password,$dbname);

if($conn->connect_error){
   die("Connection failed" .$conn->connect_error);
}

header("location: Records.php");

$conn->close();  




 














?>