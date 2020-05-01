<?php

//ini_set("display_errors",1);

include 'include/main.php';

$mains=new Maincls();

$institute_id =$_POST['institute_id'];

$session =$_POST['session'];


$sql1="INSERT INTO `admin_info` (`sl_no`, `admin_id`, `admin_name`, `user_type`, `password`, `mobile_number`, `email_id`, `user_type_code`, `created_by`, `institute_id`, `gender`, `address`) VALUES (NULL, 'admin123456', 'sss', 'developer', 'pass', '9933169269', 'modhur_beta2@gmail.com', '1', 'dba', 'dmv1234', 'female', 'earth') ";

$res1=$mains->sendQueryAndGetResult($sql1);

if($res1){



		$sql2 = "UPDATE `version_control` SET `version`=`version`+1 WHERE `institution_id` = 'dmv1234'";
		
	   	$res2=$mains->sendQueryAndGetResult($sql2);
		
		 $response["success"] = 1;

         $response["message"] = "Done.";

	     echo json_encode($response);



	     			

}else{

      $response["success"] = 0;

      $response["message"] = "Failed to connect. Please try again.";

	  echo json_encode($response);

}

?>

