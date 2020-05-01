<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$student_id =$_POST['student_id'];
$exam_name = $_POST['exam_name'];
$sql1="SELECT `student_id`, `subject`, `total`, `obtain`, `grade`, `exam_name` FROM `result_brief` WHERE `student_id`= '$student_id' AND `exam_name` = '$exam_name'";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["student_id"] = $row['student_id'];
	       $details["subject"] = $row['subject'];
	       $details["total"] = $row['total'];
	       $details["obtain"] = $row['obtain'];
	       $details["grade"] = $row['grade'];
	       $details["exam_name"] = $row['exam_name'];
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