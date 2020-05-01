<?php
//ini_set("display_errors",1);
//fetch_no_of_leave_tacken_by_teacher.php	teacher_uname	success, details, total_leave, leave_taken

include 'include/main.php';
$mains=new Maincls();
$teacher_uname ="srijeet";//$_POST['teacher_uname'];
$total_leave = 25;
$sql1="SELECT DATEDIFF(`end_date`, `start_date`) as date_dif FROM `request` WHERE `status` = 1 AND `teacher_id` = (SELECT teacher.teacher_id FROM teacher WHERE teacher.username = '$teacher_uname')";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["total_leave"] = $total_leave;
		   $details["leave_taken"] = $row['date_dif'];
	      
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