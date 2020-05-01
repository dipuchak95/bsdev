<?php
//ini_set("display_errors",1);
//fetch_faq.php		success, question, answer, asked_by


include 'include/main.php';
$mains=new Maincls();
$sql1="SELECT `sl_no`, `question`, `answer`, `asked_by`, `answered_by`, `time_stamp` FROM `asked_question` WHERE `answer` != ''";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["sl_no"] = $row['sl_no'];
		   $details["question"] = $row['question'];
		   $details["answer"] = $row['answer'];
		   $details["asked_by"] = $row['asked_by'];
		   $details["answered_by"] = $row['answered_by'];
		   $details["time_stamp"] = $row['time_stamp'];
	      
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