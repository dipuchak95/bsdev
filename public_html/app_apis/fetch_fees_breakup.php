<?php
//ini_set("display_errors",1);
//fetch_faq.php		success, question, answer, asked_by


include 'include/main.php';
$mains=new Maincls();
$month_id=$_POST['month_id'];
$class_id=$_POST['class_id'];
$sql1="SELECT * FROM `type_table`INNER JOIN fees_preview ON fees_preview.type_id = type_table.type_id WHERE fees_preview.month_id = '$month_id' AND fees_preview.class_id='$class_id'";
//echo $sql1;
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["type"] = $row['type'];
		   $details["amount"] = $row['amount'];
		   
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