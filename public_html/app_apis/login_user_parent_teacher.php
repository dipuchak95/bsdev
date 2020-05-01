<?php
include 'include/main.php';
ini_set('display_errors', 1);
$userLgn = new userLoginFuntionality();
$username = $_POST['username'];
$password = $_POST['password'];
$pass_hash = sha1($password);
$userLgn->login_funtionality($username,$pass_hash);
 class userLoginFuntionality {
	public function login_funtionality($username,$password){
      $flag_parent= $this->cheak_if_user_available_on_parent_info($username , $password );
	  $flag_teacher= $this->cheak_if_user_available_on_teacher_info($username , $password );
	 // echo $flag_parent."</br>";
	 // echo $flag_teacher."</br>";
	  if($flag_parent== -1 && $flag_teacher == -1){
		$response["success"] = 0;
        $response["message"] = "User not found";
        echo json_encode($response);
	  }
	  elseif(($flag_parent== 2 && $flag_teacher == 2) || ($flag_parent== 2 && $flag_teacher == 1) || ($flag_parent== 1 && $flag_teacher == 2)){
		$z=0;
        $student_id_list="";
		$response["success"] = 4;
        $response["message"] = "User is both parent and teacher.";
		$res2= $this->fetch_student_id_based_on_parent($username );
		if ($res2) {
			$numRows=$res2->num_rows;
		    if($numRows>0){
			    while ($row=$res2->fetch_assoc()) {
				   $z= $z+1;
           	       $student_id = $row['student_id'];
				   $student_id_list = $student_id_list.",".$student_id;
				}
				$student_id_list=substr($student_id_list, 1);
				$response["student_list"] = $student_id_list;
				$response["student_count"] = $z ; 
				
			}
		}
        echo json_encode($response);
	  }
	  else if($flag_parent== 1 || $flag_teacher == 1){
		$response["success"] = 1;
        $response["message"] = "Password Missmatch !";
        echo json_encode($response);
	  }
	  else if($flag_parent== 2 && $flag_teacher == -1){
		$z=0;
        $student_id_list="";
		$response["success"] = 2;
        $response["message"] = "User is only parent.";
		$res1= $this->fetch_student_id_based_on_parent($username );
		if ($res1) {
			$numRows=$res1->num_rows;
		    if($numRows>0){
			    while ($row=$res1->fetch_assoc()) {
				   $z= $z+1;
           	       $student_id = $row['student_id'];
				   $student_id_list = $student_id_list.",".$student_id;
				}
				$student_id_list=substr($student_id_list, 1);
				$response["student_list"] = $student_id_list;
				$response["student_count"] = $z ; 
				
			}
		}
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
	public function fetch_student_id_based_on_parent($user_name){
		$mains=new Maincls();
		$i=0;
		$student_id_list = "";
		$sql = "SELECT student.student_id FROM `parent` INNER JOIN student ON student.parent_id = parent.parent_id WHERE parent.username = '$user_name'";
		$res=$mains->sendQueryAndGetResult($sql);
		return $res;
	}
	public function cheak_if_user_available_on_parent_info($username , $password ){
		$mains=new Maincls();
		$sql_pi="SELECT `parent_id`,`password` FROM `parent` WHERE `username` = '$username' ";
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
		$sql_ti="SELECT `teacher_id`, `password` FROM `teacher` WHERE `username` = '$username'";
		//echo $sql_ti;
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