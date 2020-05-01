<?php
ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$student_roll =$_POST['student_id'];
$session =$_POST['session'];
$month =$_POST['month'];
$year =$_POST['year'];
$date=$year."-".$month;
$sql1="SELECT * FROM `student_attendance` WHERE `student_roll` = '$student_roll' AND `session` = '$session' AND `date` LIKE '$date%'";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["institution_id"] = $row['institution_id'];
	       $details["class"] = $row['class'];
	       $details["section"] = $row['section'];
	       $details["date"] = $row['date'];
	       $details["period"] = $row['period'];
	       $details["present_status"] = $row['present_status'];
	       
		   array_push($response["details"], $details);
		}
		echo json_encode($response);
	}else{
      $response["success"] = 0;
      $response["message"] = "No data found.";
	  echo json_encode($response);
}
	     			
}else{
      $response["success"] = 0;
      $response["message"] = "Failed to connect. Please try again.";
	  echo json_encode($response);
}
?>