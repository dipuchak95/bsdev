<?php
include 'include/main.php';
$mains=new Maincls();
$class_name=$_POST['class_name'];
$section_name=$_POST['section_name'];
$sql1="SELECT DISTINCT teacher.teacher_id ,teacher.username , teacher.first_name,teacher.last_name , teacher.email FROM `class_routine` INNER JOIN teacher ON teacher.teacher_id = class_routine.teacher_id INNER JOIN subject ON subject.subject_id = class_routine.section_id WHERE class_routine.class_id = (SELECT class.class_id FROM class WHERE class.name = '$class_name') AND class_routine.`section_id`=(SELECT section.section_id FROM section WHERE section.name = '$section_name' AND section.class_id = (SELECT class.class_id FROM class WHERE class.name = '$class_name'))";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["teacher_id"] = "teacher-".$row['teacher_id'];
		   $details["name"] = $row['first_name']." ".$row['last_name'];
		   $details["email"] = $row['email'];
		   $details["username"] = $row['username'];	      
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