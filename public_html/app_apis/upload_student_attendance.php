<?php
//upload_student_attendance.php
//timestamp','year','class_id','section_id','comma_seperated_roll_present','comma_seperated_roll_absent'
//success
include 'include/main.php';
//ini_set("display_errors",1);
$flag=1;
$timestamp =$_POST['timestamp'];
// modified by diptesh
$timestamp = date('yy-m-d',strtotime($timestamp));
// end modification
$year =$_POST['year'];
$class_id =$_POST['class_id'];
$section_id =$_POST['section_id'];
$comma_seperated_roll_present =$_POST['comma_seperated_roll_present'];
$comma_seperated_roll_absent =$_POST['comma_seperated_roll_absent'];
$response= array();
$mains=new Maincls();

$present_array = explode(",",$comma_seperated_roll_present);
$absent_array = explode(",",$comma_seperated_roll_absent);
$size_present_array = sizeof($present_array);
$size_absent_array = sizeof($absent_array);

for($i=0;$i<$size_present_array;$i++){
	$sql_p="INSERT INTO `attendance`(`attendance_id`, `timestamp`, `year`, `class_id`, `section_id`, `student_id`, `status`) VALUES (NULL,'$timestamp','$year','$class_id','$section_id','$present_array[$i]','1')";
	$res_p=$mains->sendQueryAndGetResult($sql_p);
	if(!$res_p){
		$flag=$flag * 0;
	}
}
for($j=0;$j<$size_absent_array;$j++){
	$sql_a="INSERT INTO `attendance`(`attendance_id`, `timestamp`, `year`, `class_id`, `section_id`, `student_id`, `status`) VALUES (NULL,'$timestamp','$year','$class_id','$section_id','$absent_array[$j]','0')";
	$res_a=$mains->sendQueryAndGetResult($sql_a);
	if(!$res_a){
		$flag=$flag * 0;
	}
}

if($flag == 1){
	$response["success"] = 1;
    $response["message"] = "success";
}else{
	$response["success"] = 0;
    $response["message"] = "failled";
}
echo json_encode($response);
?>