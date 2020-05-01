<?php

//ini_set("display_errors",1);

include 'include/main.php';

$mains=new Maincls();

$institute_id =$_POST['institute_id'];

$session =$_POST['session'];


$sql1="SELECT `date`, `type`, `name`, `institute_id`, `session` FROM `event_details` WHERE `institute_id` = '$institute_id' AND `session` = '$session' ";

$res1=$mains->sendQueryAndGetResult($sql1);

if($res1){

	$numRows=$res1->num_rows;

	if($numRows>0){

		$response["success"] = 1;

        $response["message"] = "success";

		$response["details"] = array();

		while ($row=$res1->fetch_assoc()) {

	       $details["date"] = $row['date'];

	       $details["type"] = $row['type'];

	       $details["name"] = $row['name'];

		   array_push($response["details"], $details);

		}

		echo json_encode($response);

	}else{

      $response["success"] = 0;

      $response["message"] = "Failed to fetch data. Please try again.";

	  echo json_encode($response);

}

	     			

}else{

      $response["success"] = 0;

      $response["message"] = "Failed to connect. Please try again.";

	  echo json_encode($response);

}

?>

