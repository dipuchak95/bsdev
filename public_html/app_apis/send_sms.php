<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$sender_type_code=$_POST['sender_type'];
$sender_uname = $_POST['sender_uname'];
$rec_type_code =$_POST['rec_type'];
$rec_uname =$_POST['rec_uname'];
$message_thread_code="";
$message=$_POST['message'];
$time=$_POST['time'];
$sender_type=  type_cheak($sender_type_code);
$rec_type=  type_cheak($rec_type_code);

$sender_id_qry =query_generator($sender_type_code,$sender_uname);
$rec_id_qry =query_generator($rec_type_code,$rec_uname);
/*
echo "sender_type    :  ".$sender_type."</br>";
echo "sender_id_qry  :  ".$sender_id_qry."</br>";
echo "rec_type       :  ".$rec_type."</br>";
echo "rec_id_qry     :  ".$rec_id_qry."</br>";
*/
$res_sen=$mains->sendQueryAndGetResult($sender_id_qry);
$res_rec=$mains->sendQueryAndGetResult($rec_id_qry);
$row_sen=$res_sen->fetch_assoc();
$row_rec=$res_rec->fetch_assoc();
$sender_id = $row_sen['id'];
$res_id = $row_rec['id'];
$id1=$sender_type."-".$sender_id;
$id2=$rec_type."-".$res_id;



$sql1="SELECT * FROM `message_thread` WHERE (`sender` = '$id1' AND `reciever` = '$id2') OR (`sender` = '$id2' AND `reciever` = '$id1')";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
  $numRows=$res1->num_rows;
  if($numRows>0){
    $row=$res1->fetch_assoc();
    $message_thread_code = $row['message_thread_code'];
    //echo $message_thread_code;
    }else{
      $d=mktime(11, 14, 54, 8, 12, 2014);
         $code = (rand(00000,99999)).date("Y-m-d h:i:sa", $d).(rand(00000,99999));
         //echo(rand(00000,99999));
         $message_thread_code = hash('adler32', $code);
         //echo $message_thread_code;
         $sql3="INSERT INTO `message_thread`(`message_thread_id`, `message_thread_code`, `sender`, `reciever`, `last_message_timestamp`) VALUES (NULL,'$message_thread_code','$id1','$id2',CURRENT_TIMESTAMP)";
         $res3=$mains->sendQueryAndGetResult($sql3);
         //echo $sql3."</br></br>";
    }
}
$sql4 = "INSERT INTO `message`(`message_id`, `message_thread_code`, `message`, `sender`, `timestamp`, `read_status`, `file_name`, `reciever`, `file_type`) VALUES (NULL,'$message_thread_code','$message','$id1','$time','0','','$id2','')";
//echo $sql4."</br></br>";
$res4=$mains->sendQueryAndGetResult($sql4);
if($res4){
      $response["success"] = 1;
      $response["message"] = "Success.";
      $response["message_thread_code"] = $message_thread_code;
      echo json_encode($response);
}else{
      $response["success"] = 0;
      $response["message"] = "Failed.";
      $response["sql"] = $sql4;
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
     $sq="SELECT parent.parent_id as id FROM parent WHERE parent.username='$uname'";
     return $sq;
   }elseif($type==5){
      $sq="SELECT admin.admin_id as id FROM admin where admin.username='$uname'";
      return $sq;
   }elseif ($type==3) {
      $sq="SELECT teacher.teacher_id as id FROM teacher WHERE teacher.username = '$uname'";
      return $sq;
   } 
}

?>