<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$sender_type_code=$_POST['type'];
$sender_uname = $_POST['uname'];
$sender_type=  type_cheak($sender_type_code);

$sender_id_qry =query_generator($sender_type_code,$sender_uname);

/*
echo "sender_type    :  ".$sender_type."</br>";
echo "sender_id_qry  :  ".$sender_id_qry."</br>";
echo "rec_type       :  ".$rec_type."</br>";
echo "rec_id_qry     :  ".$rec_id_qry."</br>";
*/
$res_sen=$mains->sendQueryAndGetResult($sender_id_qry);
$row_sen=$res_sen->fetch_assoc();
$sender_id = $row_sen['id'];
$id1=$sender_type."-".$sender_id;

$sql1="SELECT  `message_thread_code`,`sender`,`reciever` FROM `message_thread` WHERE (`sender`='$id1'  OR  `reciever`='$id1')";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
    $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["message_thread_code"] = $row['message_thread_code'];	
         $sender = $row['sender'];
         $details["sender_type"]= get_user_type($sender); 
         $details["sender_username"]= get_username($sender,$mains);	
         $details["sender"]=get_user_name($sender,$mains);
         $reciever=$row['reciever']; 
         $details["reciever_type"]= get_user_type($reciever);       
	       $details["reciever"] = get_user_name($reciever,$mains);
         $details["reciever_username"]= get_username($reciever,$mains);
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

function query_generator($type,$uname) {
   if($type==2){
     $sq="SELECT parent.parent_id as id ,parent.first_name as fname , parent.last_name as lname FROM parent WHERE parent.username='$uname'";
     return $sq;
   }elseif($type==5){
      $sq="SELECT admin.admin_id as id , admin.first_name as fname , admin.last_name as lname FROM admin where admin.username='$uname'";
      return $sq;
   }elseif ($type==3) {
      $sq="SELECT teacher.teacher_id as id ,teacher.first_name as fname , teacher.last_name as lname FROM teacher WHERE teacher.username = '$uname'";
      return $sq;
   } 
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
function get_type($type) {
   if($type=="parent"){
      return 2;
   }elseif($type=="teacher"){
      return 3;
   }elseif ($type=="admin") {
      return 5;
   } 
}
function get_user_type($type) {
   $arr_uname = explode('-', $type);
   $user_type = get_type($arr_uname[0]);
   return $user_type;
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
   } 
}
function type_cheak($type) {
   if($type==2){
      return "parent";
   }elseif($type==3){
      return "teacher";
   }elseif ($type==5) {
      return "admin";
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