<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$school_id =$_POST['school_id'];
$class =$_POST['class'];
$section =$_POST['section'];
$session =$_POST['session'];
$sql = "SELECT * FROM `student_info` WHERE `school_id` = '$school_id' AND `class` = '$class' AND `section` = '$section' AND `session` = '$session'";
$res=$mains->sendQueryAndGetResult($sql);
if($res){
	$numRows=$res->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res->fetch_assoc()) {
	       $details["student_name"] = $row['student_name'];
	       $details["student_id"] = $row['student_id'];
	       $details["roll_no"] = $row['roll_no'];
		   array_push($response["details"], $details);
		}
		echo json_encode($response);
	}else{
      $response["success"] = 0;
      $response["message"] = "No data found";
	  echo json_encode($response);
    }   			
}else{
		$response["success"] = 0;
        $response["message"] = "Failed to fetch data. Please try again.";
	    echo json_encode($response);
}
?>