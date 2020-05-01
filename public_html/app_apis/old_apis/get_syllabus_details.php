<?php
ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();

$intitutionId= $_POST['intitutionId'];
$session=$_POST['session'];
$class=$_POST['class'];
$section=$_POST['section'];
$type=$_POST['type']; 


$sql = "SELECT * FROM `syllabus_details` INNER JOIN teacher_info ON teacher_info.teacher_id = syllabus_details.teacher_id WHERE syllabus_details.institute_id = '$intitutionId' AND `section`='$section' AND `class` = '$class' AND `session` = '$session' AND `type` = $type";
$result =$mains->sendQueryAndGetResult($sql);
	if($result){
       $numRows=$result->num_rows;
	   if($numRows>0){
		   $response["success"] = 1;
           $response["message"] = "success";
		   $response["details"] = array();
		   while ($row=$result->fetch_assoc()) {
	          $details["examName"] = $row['exam_name'];
	          $details["subjectName"] = $row['subject_name'];
	          $details["teacherName"] = $row['teacher_name'];
	          $details["publichDate"] = $row['publish_date'];
	          $details["syllabusLink"] = $row['syllabus_link'];
		      array_push($response["details"], $details);
		    }
		    echo json_encode($response);
	    }else{
           $response["success"] = 0;
           $response["message"] = "No data found.";
		   $response["sql"] = $sql;
	       echo json_encode($response);
        }
       		
    }else{
		
		   $response["success"] = 0;
           $response["message"] = "Failed to execute query.";
	       echo json_encode($response);
	}
	


?>