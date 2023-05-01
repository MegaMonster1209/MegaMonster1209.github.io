<?php 

$server = "localhost";
$username = "root";
$password = "";
$dbname = "qrdatabase";
$conn = new mysqli($server,$username,$password,$dbname);
if($conn->connect_error){
   die("Connection failed" .$conn->connect_error);
}

$filename = 'List of Records'.date('Y-m-d').'.csv';
$sql = "SELECT * FROM record";

$array = array();

$file = fopen($filename,'w');
$array = array("ID","tName","Grade","Section","STUDENTID","CONTACT","DateCreated");
fputcsv($file,$array);

$result = $conn->query($sql);
    while($row = mysqli_fetch_array($result)){
        $id = $row['ID'];
        $Name = $row['tName'];
        $Grade =  $row['Grade'];
        $Section = $row['Section'];
        $STUDENTID =  $row['STUDENTID'];
        $CONTACT = $row['CONTACT'];
        $DateCreated =  $row['DateCreated'];

    $array = array( $id,$Name,$Grade,$Section,$STUDENTID,$CONTACT,$DateCreated);
    fputcsv($file,$array);
}
fclose($file);

header("Content-Description: File Transfer");
header("Content-Disposition: Attachment; filename=$filename"); 
header("Content-Type: application/csv"); 

readfile($filename);
unlink($filename);
exit();
?>