<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$student_id =$_POST['student_id'];
$sql1="SELECT `student_id`, `exam_name`, `percent`, `grade`, `total`, `date` FROM `result` WHERE `student_id` = '$student_id' ";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["student_id"] = $row['student_id'];
		   $details["exam_name"] = $row['exam_name'];
		   $details["percent"] = $row['percent'];
		   $details["grade"] = $row['grade'];
		   $details["total"] = $row['total'];
		   $details["date"] = $row['date'];
	      
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