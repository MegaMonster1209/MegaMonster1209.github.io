<?php
   session_start(); 
   $server = "localhost";
   $username = "root";
   $password = "";
   $dbname = "qrdatabase";
   $conn = new mysqli($server,$username,$password,$dbname);

   if($conn->connect_error){
      die("Connection failed" .$conn->connect_error);
   }

   function validate($data){
      $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }

  if (isset($_POST['text'])) {
    $text = validate($_POST['text']);
    date_default_timezone_set("Asia/Manila");
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $sql = "SELECT * FROM record WHERE STUDENTID='$text'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student_id = $row['STUDENTID'];
        $previous_sql = "SELECT * FROM attendance WHERE STUDENTID='$student_id' AND LOGDATE < '$date' AND STATUS='0' ORDER BY LOGDATE DESC LIMIT 1";
        $previous_result = $conn->query($previous_sql);

        if ($previous_result->num_rows > 0) {
            $previous_row = $previous_result->fetch_assoc();
            $previous_date = $previous_row['LOGDATE'];
            if (strtotime($previous_date) == strtotime('-1 day', strtotime($date))) {
                $sql = "UPDATE attendance SET TIMEOUT=NOW(), STATUS='1' WHERE STUDENTID='$student_id' AND LOGDATE='$previous_date'";
                $query = $conn->query($sql);
                $_SESSION['success'] = "Successfully timed out";
            } else {
                $sql = "INSERT INTO attendance(Name, Grade, Section, STUDENTID, TIMEIN, LOGDATE, STATUS) SELECT record.tName, record.Grade, record.Section, '$student_id', '$time', '$date', '0' FROM record WHERE record.STUDENTID = '$student_id'";

                if ($conn->query($sql) === TRUE) {
                    $_SESSION['success'] = "Attendance added successfully";
                    echo "<script>
                    var audio = new Audio(Success.mp3');
                    audio.play();
                    </script>";
                } else {
                    $_SESSION['error'] = $conn->error;
                }
            }
        } else {
            $sql = "INSERT INTO attendance(Name, Grade, Section, STUDENTID, TIMEIN, LOGDATE, STATUS) SELECT record.tName, record.Grade, record.Section, '$student_id', '$time', '$date', '0' FROM record WHERE record.STUDENTID = '$student_id'";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['success'] = "Attendance added successfully";
                echo "<script>
                var audio = new Audio(Success.mp3');
                audio.play();
                </script>";
            } else {
                $_SESSION['error'] = $conn->error;
            }
        }
    } else {
        $_SESSION['error'] = $conn->error;
    }
    header("location: index.php");
    $conn->close();
}