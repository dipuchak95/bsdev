<?php
//ini_set("display_errors",1);
//change_phone_number.php	username, type, mob	success

include 'include/main.php';
$mains=new Maincls();
$username =$_POST['username'];
$type =$_POST['type'];
$mob =$_POST['mob'];

if($type== 2){
   $sql1="UPDATE `parent` SET `phone`='$mob' WHERE `username` ='$username'";
}else if($type== 3){
	$sql1="UPDATE `teacher` SET `phone`='$mob' WHERE `username`='$username'";
}else if($type== 4){
	$sql1="UPDATE parent t1, teacher t2 SET t1.phone = '$mob' , t2.phone ='$mob' WHERE t1.username = '$username' and t2.username = '$username'";
}

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