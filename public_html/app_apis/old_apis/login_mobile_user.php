<?php
include 'include/main.php';
$userLgn = new userLoginFuntionality();
$username = $_POST['username'];
$password = $_POST['password'];
$userLgn->login_funtionality($username,$password);

 class userLoginFuntionality {
	public function login_funtionality($username,$password){
      $flag_parent= $this->cheak_if_user_available_on_parent_info($username , $password );
	  
	  $flag_teacher= $this->cheak_if_user_available_on_teacher_info($username , $password );
	  
	  if($flag_parent== -1 && $flag_teacher == -1){
		$response["success"] = 0;
        $response["message"] = "User not found";
        echo json_encode($response);
	  }
	  elseif(($flag_parent== 2 && $flag_teacher == 2) || ($flag_parent== 2 && $flag_teacher == 1) || ($flag_parent== 1 && $flag_teacher == 2)){
		$response["success"] = 4;
        $response["message"] = "User is both parent and teacher.";
        echo json_encode($response);
	  }
	  else if($flag_parent== 1 || $flag_teacher == 1){
		$response["success"] = 1;
        $response["message"] = "Password Missmatch !";
        echo json_encode($response);
	  }
	  else if($flag_parent== 2 && $flag_teacher == -1){
		$response["success"] = 2;
        $response["message"] = "User is only parent.";
        echo json_encode($response);
	  }
	  else if($flag_parent== -1 && $flag_teacher == 2){
		$response["success"] = 3;
        $response["message"] = "User is only  teacher.";
        echo json_encode($response);
	  }
	  
	  else{
		$response["success"] = -1;
        $response["message"] = "No condition matched.";
        echo json_encode($response);
	  }

	}
	public function cheak_if_user_available_on_parent_info($username , $password ){
		$mains=new Maincls();
		$sql_pi="SELECT  `parent_id`, `parent_name`, `parent_mobile_number`, `parent_mail_id`, `parent_user_id`, `password` FROM `parent_info` WHERE `parent_mobile_number` = '$username'";
		$res_pi=$mains->sendQueryAndGetResult($sql_pi);
		if ($res_pi) {
			$numRows=$res_pi->num_rows;
		    if($numRows>0){
			    while ($row=$res_pi->fetch_assoc()) {
           	       $saved_password = $row['password'];
				   if($saved_password == $password){
					 return 2;  
				   }else{
					   return 1;
				   }
             	}
            }else{
            	return -1;
            }

        }else{
        	return -2;
        }
      

	}
	public function cheak_if_user_available_on_teacher_info($username,$password ){
		$mains=new Maincls();
		$sql_ti="SELECT `sl_no`, `teacher_id`, `teacher_user_id`, `teacher_name`, `teacher_mail_id`, `teacher_mobile_number`, `password`, `school_id` FROM `teacher_info` WHERE `teacher_mobile_number`='$username'";
		$res_ti=$mains->sendQueryAndGetResult($sql_ti);
			if ($res_ti) {
			$numRows=$res_ti->num_rows;
		    if($numRows>0){
			    while ($row=$res_ti->fetch_assoc()) {
           	       $saved_password = $row['password'];
				   if($saved_password == $password){
					 return 2;  
				   }else{
					   return 1;
				   }
             	}
            }else{
            	return -1;
            }

        }else{
        	return -2;
        }

	}
	
	
}
?>