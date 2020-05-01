<?php
ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$institute_id =$_POST['institute_id'];
$class =$_POST['class'];
$section =$_POST['section'];
$sql1="SELECT * FROM `homework` WHERE `institute_id` = '$institute_id' AND `class` = '$class' AND `section`= '$section'";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["teacher_id"] = $row['teacher_id'];
	       $details["subject"] = $row['subject'];
	       $details["title"] = $row['title'];
	       $details["description"] = $row['description'];
	       $details["HW_date"] = $row['HW_date'];
	       $details["submission_date"] = $row['submission_date'];
	       $details["image_link"] = $row['image_link'];
		   array_push($response["details"], $details);
		}
		echo json_encode($response);
	}else{
      $response["success"] = 0;
      $response["message"] = "Failed to fetch data. Please try again.";
	  echo json_encode($response);
}
	     			
}else{
      $response["success"] = 0;
      $response["message"] = "Failed to connect. Please try again.";
	  echo json_encode($response);
}
?>
