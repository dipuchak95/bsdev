<?php
//ini_set("display_errors",1);
//fetch_notification.php	user_type, student_id, teacher_id	success, details, notify, date, time, url, user_type

include 'include/main.php';
$mains=new Maincls();
$user_type =$_POST['user_type'];
$student_id =$_POST['student_id'];
$teacher_id =$_POST['teacher_id'];

if($user_type == 2){
   $sql1="SELECT `date`, `time`, `notify`, `url`, `user_type` FROM `notification` WHERE `user_id` = '$student_id' AND user_type = 'student' ORDER BY date DESC";
}else if($user_type == 3){
   $sql1="SELECT `date`, `time`, `notify`, `url`, `user_type` FROM `notification` WHERE `user_id` = (SELECT teacher.teacher_id FROM teacher WHERE teacher.username='$teacher_id') AND user_type = 'teacher'  ORDER BY date DESC";
}


$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["date"] = $row['date'];
		   $details["time"] = $row['time'];
		   $details["notify"] = $row['notify'];
		   $details["url"] = $row['url'];
           $ut= $row['user_type'];
           if($ut=='admin'){
           	  $details["user_type"]=5;
           }else if($ut=='parent'){
           	  $details["user_type"]=2;
           }else if($ut=='teacher'){
           	  $details["user_type"]=3;
           }else {
           	  $details["user_type"]=6;
           }
		   
	      
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