<?php
$sender = "admin-1";
$details= get_user_type($sender);
echo $details; 



function get_user_type($type) {
   $arr_uname = explode("-", $type);
   print_r($arr_uname);
   echo $arr_uname[0]."</br>";
   $user_type = get_type($arr_uname[0]);
   return $user_type;
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
?>