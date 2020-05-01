<?php
//fetch_attendance_based_on_student_id.php
//student_id, session, month, year	
//success, details, timestamp, status
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$student_id =$_POST['student_id'];
$session =$_POST['session'];
$month =$_POST['month'];
$year =$_POST['year'];
$prev_year = $year -1;
$response= array();
// if year validation(2019-2020) needed, then uncomment this sql1 anc comment another sql1
// $sql1 ="SELECT `attendance_id`, `timestamp`, `year`, `class_id`, `section_id`, `student_id`, `status` FROM `attendance` WHERE `student_id`= '$student_id' AND `year`= '$prev_year-$year'  AND `timestamp` like '$year-$month%'";
$sql1 ="SELECT `attendance_id`, `timestamp`, `year`, `class_id`, `section_id`, `student_id`, `status` FROM `attendance` WHERE `student_id`= '$student_id' AND `timestamp` like '$year-$month%'";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	
	$numRows=$res1->num_rows;
	if($numRows>0){
	    $response["success"] = 1;
        $response["message"] = "success";
	    $response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
		    $details= array();
	        $details["timestamp"] = $row['timestamp'];
	        $details["status"] = $row['status'];
	        array_push($response["details"], $details);
	    }
	}else{
		$response["success"] = 0;
        $response["message"] = "failled";
        //$response["message"] = $sql1;
	}
}else{
	$response["success"] = 0;
    $response["message"] = "failled";
    //$response["message"] = $sql1;
}
echo json_encode($response);
?>