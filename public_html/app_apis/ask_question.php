<?php
//ini_set("display_errors",1);
//ask_question.php	ques, user_id	success


include 'include/main.php';
$mains=new Maincls();
$ques =$_POST['ques'];
$user_id =$_POST['user_id'];

$sql1="INSERT INTO `asked_question`(`sl_no`, `question`, `answer`, `asked_by`, `answered_by`, `time_stamp`) VALUES (NULL,'$ques','','$user_id','',CURRENT_TIMESTAMP)";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	
		$response["success"] = 1;
        $response["message"] = "Success";
        echo json_encode($response);	      		
}else{
        $response["success"] = 0;
        $response["message"] = "Failled.";
        echo json_encode($response);
}
	     			

?>