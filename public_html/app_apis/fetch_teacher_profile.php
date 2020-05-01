<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$user_name = $_POST['username'];
$sql = "SELECT `teacher_id`, `first_name`, `last_name`, `sex`, `address`, `birthday`, `phone`, `email`, `password`, `idcard`, `username`, `token`, `user_code`, `fb_token`, `fb_id`, `fb_photo`, `fb_name`, `g_oauth`, `g_fname`, `femail`, `g_lname`, `g_picture`, `link`, `g_email`, `image`, `since` FROM `teacher` WHERE `username` ='$user_name'";
$result =$mains->sendQueryAndGetResult($sql);
$numRows=$result->num_rows;
if($result){
	$numRows=$result->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$result->fetch_assoc()) {
	       $details["first_name"] = $row['first_name'];
		   $details["last_name"] = $row['last_name'];
		   $details["email"] = $row['email'];
		   $details["phone"] = $row['phone'];
		   $details["address"] = $row['address'];
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