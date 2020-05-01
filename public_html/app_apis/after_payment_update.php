<?php
//ini_set("display_errors",1);
//after_payment_update.php	
//student_id','month_id_list','class_id','txn_id','total_discount','total_fine','total_amount'	
//success
include 'include/main.php';
$mains=new Maincls();
$student_id= $_POST['student_id'];
$month_id_list= $_POST['month_id_list'];
$class_id=$_POST['class_id'];
$txn_id= $_POST['txn_id'];
$total_discount= $_POST['total_discount'];
$total_fine= $_POST['total_fine'];
$total_amount= $_POST['total_amount'];




$sql2="INSERT INTO `fine_details`(`student_id`, `fine_id`, `amount`, `discount`, `status`, `transaction_id`, `description`) VALUES ('$student_id','1','$total_fine','$total_discount','1','$txn_id','')";
$res2=$mains->sendQueryAndGetResult($sql2);
$random1 = rand(0,9999);
$random2 = rand(0,9999);
$random3 = rand(0,999);
$ran=$random1.$random2.$random3;

$sql3="INSERT INTO `payment`(`payment_id`, `expense_category_id`, `title`, `payment_type`, `invoice_id`, `student_id`, `method`, `description`, `amount`, `timestamp`, `year`, `month`) VALUES (NULL,NULL,'','','$ran','$student_id','','','$total_amount',CURRENT_TIMESTAMP, YEAR(CURDATE()) ,MONTH(CURDATE()))";

//echo $sql3;
$res3=$mains->sendQueryAndGetResult($sql3);


$sql4="INSERT INTO `invoice`(`invoice_id`, `student_id`, `title`, `description`, `amount`, `amount_paid`, `due`, `creation_timestamp`, `payment_timestamp`, `payment_method`, `payment_details`, `status`, `year`, `class_id`) VALUES ($ran,'$student_id','','','$total_amount','$total_amount','0',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'1','','completed',YEAR(CURDATE()),'$class_id')";
$res4=$mains->sendQueryAndGetResult($sql4);

$month=explode(',', $month_id_list);
$sz=sizeof($month);
for($i=0;$i<$sz;$i++){
	$sql1="INSERT INTO `fees_payment_history`(`student_id`, `month_id`, `status`, `class_id`) VALUES ('$student_id',$month[$i],'1','$class_id')";
    $res1=$mains->sendQueryAndGetResult($sql1);
    //echo $sql1."</br></br></br>";
}

if($res1){
      $response["success"] = 1;
      $response["message"] = "Done.";
	  echo json_encode($response);
}else{
	  $response["success"] = 0;
      $response["message"] = "Failed to connect. Please try again.";
	  echo json_encode($response);
}

?>