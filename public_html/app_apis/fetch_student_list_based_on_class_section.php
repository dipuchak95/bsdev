<?php
//fetch_student_list_based_on_class_section.php	
//class, section	
//success, details, {"name":"Raghvendra Singh","class":"Class 1","section":"A","roll":"111","id":"1","parent_user_name":"Raghvendra Singh"}
//ini_set("display_errors",1);
$class =$_POST['class'];
$section =$_POST['section'];
include 'include/main.php';
$response= array();
$mains=new Maincls();
$sql1 = "SELECT student.first_name as student_fname, student.last_name as student_lname , parent.username,enroll.roll ,enroll.class_id,enroll.section_id ,  student.student_id FROM enroll INNER JOIN student ON student.student_id = enroll.student_id INNER JOIN parent ON parent.parent_id = student.parent_id WHERE enroll.class_id = (SELECT class_id from class WHERE class.name = '$class' LIMIT 1) AND enroll.section_id = (SELECT section_id FROM section WHERE section.name = '$section' LIMIT 1) ";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
			$details["name"] = $row['student_fname']." ".$row['student_lname'];
			$details["class"] = $class;//$row['class_id'];
			$details["section"] =$section ;//= $row['section_id'];
			$details["class_id"] = $row['class_id'];
			$details["section_id"] = $row['section_id'];
			$details["roll"] = $row['roll'];
			$details["id"] = $row['student_id'];
			$details["parent_user_name"] = $row['username'];

		  array_push($response["details"], $details);
		}
    }else{
      $response["success"] = 0;
      $response["message"] = "No data found.";
	  echo json_encode($response);
    }
}else{
      $response["success"] = 0;
      $response["message"] = "Failled to run query.";
	  echo json_encode($response);
}
echo json_encode($response);
?>