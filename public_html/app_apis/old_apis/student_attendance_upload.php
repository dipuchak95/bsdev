<?php
ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$flag=1;
$institute_id =$_POST['institute_id'];
$class =$_POST['class'];
$section =$_POST['section'];
$teacher_id =$_POST['teacher_id'];
$session =$_POST['session'];
$date =$_POST['date'];
$period =$_POST['period'];
$comma_seperated_roll_present =$_POST['comma_seperated_roll_present'];
$comma_seperated_roll_absent =$_POST['comma_seperated_roll_absent'];
$present_array = explode(",",$comma_seperated_roll_present);
$absent_array = explode(",",$comma_seperated_roll_absent);
$size_present_array = sizeof($present_array);
$size_absent_array = sizeof($absent_array);
for($i=0;$i<$size_present_array;$i++){
	$sql_p="INSERT INTO `student_attendance`(`sl_no`, `institution_id`, `class`, `section`, `teacher_id`, `student_roll`,`date`, `period`, `present_status`,`session`) VALUES (NULL,'$institute_id','$class','$section','$teacher_id','$present_array[$i]','$date','$period','1','$session')";
	$res_p=$mains->sendQueryAndGetResult($sql_p);
	if(!$res_p){
		$flag=$flag * 0;
	}
}
for($j=0;$j<$size_absent_array;$j++){
	$sql_a="INSERT INTO `student_attendance`(`sl_no`, `institution_id`, `class`, `section`, `teacher_id`, `student_roll`,`date`, `period`, `present_status`,`session`) VALUES (NULL,'$institute_id','$class','$section','$teacher_id','$absent_array[$j]','$date','$period','0','$session')";
	$res_a=$mains->sendQueryAndGetResult($sql_a);
	if(!$res_p){
		$flag=$flag * 0;
	}
}
if($flag == 1){
    $response["success"] = 1;
    $response["message"] = " uploaded.";
    echo json_encode($response);
}else{
	$response["success"] = 0;
    $response["message"] = "failed.";
    echo json_encode($response);	
}

?>