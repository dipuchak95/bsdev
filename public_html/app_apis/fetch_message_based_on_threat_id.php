<?php
//ini_set("display_errors",1);
//fetch_gallery.php		success, details, "sl_no":"1","title":"Title","description":"Description","image_link":"https:\/\/i

include 'include/main.php';
$mains=new Maincls();
$message_thread_code =$_POST['message_thread_code'];//'teacher';
$sql1="SELECT `message_id`, `message_thread_code`, `message`, `sender`, `timestamp`, `read_status`, `file_name`, `reciever`, `file_type` FROM `message` WHERE `message_thread_code` = '$message_thread_code' order by timestamp desc ";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["message"] = $row['message'];	
	       $sender = $row['sender'];
	       $details["sender_username"]=	get_username($sender,$mains);
           $details["sender"]=get_user_name($sender,$mains);
           $reciever=$row['reciever'];        
	       $details["reciever"] = get_user_name($reciever,$mains);
	       $details["reciever_username"]=	get_username($reciever,$mains);
	       $details["timestamp"] = $row['timestamp'];	      
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


function get_user_name($uname,$mains) {
  $arr_uname = explode('-', $uname);
  $user_type = get_type($arr_uname[0]);
  $qry=qry_generator($user_type,$arr_uname[1]);
  $res=$mains->sendQueryAndGetResult($qry);
  $row=$res->fetch_assoc();
  $name = $row['fname']." ".$row['lname'];
  return $name;
  
}
function get_username($uname,$mains) {
  $arr_uname = explode('-', $uname);
  $user_type = get_type($arr_uname[0]);
  $qry=qry_generator2($user_type,$arr_uname[1]);
  $res=$mains->sendQueryAndGetResult($qry);
  $row=$res->fetch_assoc();
  $uname = $row['username'];
  return $uname;
  
}
function get_type($type) {
   if($type=="parent"){
      return 2;
   }elseif($type=="teacher"){
      return 3;
   }elseif ($type=="admin") {
      return 5;
   }elseif ($type=="student") {
      return 6;
   } 
}
function qry_generator($type,$uname) {
   if($type==2){
     $sq="SELECT parent.parent_id as id ,parent.first_name as fname , parent.last_name as lname FROM parent WHERE parent.parent_id='$uname'";
     return $sq;
   }elseif($type==5){
      $sq="SELECT admin.admin_id as id , admin.first_name as fname , admin.last_name as lname FROM admin where admin.admin_id='$uname'";
      return $sq;
   }elseif ($type==3) {
      $sq="SELECT teacher.teacher_id as id ,teacher.first_name as fname , teacher.last_name as lname FROM teacher WHERE teacher.teacher_id = '$uname'";
      return $sq;
   }elseif ($type==6) {
      $sq="SELECT student.student_id as id ,student.first_name as fname , student.last_name as lname FROM student WHERE student.student_id = '$uname'";
      return $sq;
   } 
}
function qry_generator2($type,$uname) {
   if($type==2){
     $sq="SELECT parent.username as username,parent.parent_id as id ,parent.first_name as fname , parent.last_name as lname FROM parent WHERE parent.parent_id='$uname'";
     return $sq;
   }elseif($type==5){
      $sq="SELECT admin.username as username,admin.admin_id as id , admin.first_name as fname , admin.last_name as lname FROM admin where admin.admin_id='$uname'";
      return $sq;
   }elseif ($type==3) {
      $sq="SELECT teacher.username as username,teacher.teacher_id as id ,teacher.first_name as fname , teacher.last_name as lname FROM teacher WHERE teacher.teacher_id = '$uname'";
      return $sq;
   }elseif ($type==6) {
      $sq="SELECT student.username as username , student.student_id as id ,student.first_name as fname , student.last_name as lname FROM student WHERE student.student_id = '$uname'";
      return $sq;
   } 
}

?>