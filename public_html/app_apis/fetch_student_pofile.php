<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$student_id = $_POST['student_id'];
$sql = "SELECT `enroll_id`, `enroll_code`, enroll.`student_id`,student.first_name,student.last_name , enroll.`class_id`, enroll.`section_id`, `roll`, `date_added`, enroll.`year`,class.name as cname , section.name as sname FROM `enroll` INNER JOIN student ON student.student_id = enroll.student_id INNER JOIN class ON class.class_id = enroll.class_id INNER JOIN section ON section.section_id = enroll.section_id WHERE student.`student_id` = '$student_id'";
$result =$mains->sendQueryAndGetResult($sql);
$numRows=$result->num_rows;
if($result){
	$numRows=$result->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$result->fetch_assoc()) {
	       $details["first_name"] = $row['first_name'];
		   $details["last_name"] = $row['last_name'];
		   $details["class_id"] = $row['class_id'];
		   $details["section_id"] = $row['section_id'];
		   $details["roll"] = $row['roll'];
		   $details["class_name"] = $row['cname'];
		   $details["section_name"] = $row['sname'];
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