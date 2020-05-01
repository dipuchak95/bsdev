<?php
//ini_set("display_errors",1);
//teacher_leave_apply.php	teacher_user_name, start_date, end_date, description, title	success



include 'include/main.php';
$mains=new Maincls();
$teacher_user_name =$_POST['teacher_user_name'];
$start_date =$_POST['start_date'];
$end_date =$_POST['end_date'];
$description =$_POST['description'];
$title =$_POST['title'];

$sql1="INSERT INTO `request`(`request_id`, `teacher_id`, `start_date`, `end_date`, `status`, `description`, `title`, `file`) VALUES (NULL,(SELECT teacher.teacher_id FROM teacher WHERE teacher.username = '$teacher_user_name'),'$start_date','$end_date',0,'$description','$title','')";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	
		$response["success"] = 1;
        $response["message"] = "Success";
        echo json_encode($response);	      		
}else{
        $response["success"] = 0;
        $response["message"] = "Failled.";
        $response["sql"] = $sql1;
        echo json_encode($response);
}
	     			

?>