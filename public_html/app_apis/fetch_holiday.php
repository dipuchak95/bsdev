<?php
//ini_set("display_errors",1);
//fetch_holiday.php		success, details, title, start, end



include 'include/main.php';
$mains=new Maincls();
$sql1="SELECT `id`, `title`, `color`, `start`, `end` FROM `events` WHERE 1";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
		   $details["title"] = $row['title'];
		   $details["start"] = $row['start'];
		   $details["end"] = $row['end'];
	      
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