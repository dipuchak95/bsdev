<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$sender_type_code=$_POST['type'];
$sender_uname = $_POST['uname'];
$message_thread_code =$_POST['message_thread_code'];
$message = $_POST['message'];
$time = $_POST['time'];
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


$sql1="SELECT  `message_thread_code`,`sender`,`reciever` FROM `message_thread` WHERE message_thread_code='$message_thread_code' LIMIT 1 ";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		
		while ($row=$res1->fetch_assoc()) {
         $sender = $row['sender'];	
         $reciever=$row['reciever'];        
         if($id1 != $sender){
            $reciever= $sender;
            $sender=$id1;
         }
         $sql4 = "INSERT INTO `message`(`message_id`, `message_thread_code`, `message`, `sender`, `timestamp`, `read_status`, `file_name`, `reciever`, `file_type`) VALUES (NULL,'$message_thread_code','$message','$sender','$time','0','','$reciever','')";
         //echo $sql4."</br></br>";
         $res4=$mains->sendQueryAndGetResult($sql4);
         if($res4){
               $response["success"] = 1;
               $response["message"] = "Success.";
               echo json_encode($response);
         }else{
               $response["success"] = 0;
               $response["message"] = "Failed.";
               echo json_encode($response);  
         }
		   
		}
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




function type_cheak($type) {
   if($type==2){
      return "parent";
   }elseif($type==3){
      return "teacher";
   }elseif ($type==5) {
      return "admin";
   } 
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


?>