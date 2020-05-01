<?php
//ini_set("display_errors",1);
//{"success":1,"message":"success","details":[{"id":"1","user_id":"1","user_type":"teacher","date":"08 Feb, 2020","time":"04:50 PM","status":"0","notify":"New Notice Info","original_id":"0","original_type":"admin","url":"teacher\/panel","type":"news","class_id":"0","subject_id":"0","year":"2019-2020","section_id":null}]}

include 'include/main.php';
$mains=new Maincls();


$sql1="SELECT `news_id`, `news_code`, `description`, `date`, `type`, `date2`, `publish_date`, `admin_id` FROM `news` WHERE 1";



$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["news_id"] = $row['news_id'];
		   $details["description"] = $row['description'];
		   $details["date"] = $row['date'];
		   $details["publish_date"] = $row['publish_date'];
	      
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