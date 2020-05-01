<?php
//fetch_syllabus.php
//class, section, type
//success, details, examName, subjectName, teacherName, publichDate, syllabusLink

//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$class =$_POST['class'];
$section =$_POST['section'];
$type =$_POST['type'];
$sql1="SELECT syllabus_details.subject_name , syllabus_details.exam_name,syllabus_details.syllabus_link,syllabus_details.publish_date,teacher.first_name,teacher.last_name FROM `syllabus_details` INNER JOIN teacher ON teacher.teacher_id=syllabus_details.teacher_id WHERE `class` = '$class' AND `section`='$section' AND `type`='$type'";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["examName"] = $row['exam_name'];
		   $details["subjectName"] = $row['subject_name'];
		   $details["teacherName"] = $row['first_name']." ".$row['last_name'];
		   $details["publichDate"] = $row['publish_date'];
		   $details["syllabusLink"] = $row['syllabus_link'];	      
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