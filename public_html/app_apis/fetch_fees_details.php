<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$student_id =$_POST['student_id'];
$details=array();
$response=array();
$response['data']=array();
$sql1="SELECT `class_id` FROM `enroll` WHERE `student_id` =$student_id";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$row1=$res1->fetch_assoc();
	$class_id = $row1['class_id'];
	$sql2="SELECT `class_id`, fee_structure.`month_id`, `amount`, `last_date`, `fine_id`,month_table.month,fine_type.fine_amount FROM `fee_structure`INNER JOIN month_table ON month_table.month_id = fee_structure.month_id INNER JOIN fine_type ON fine_type.fine_type_id = fee_structure.fine_id  WHERE `class_id` =$class_id";
	$res2=$mains->sendQueryAndGetResult($sql2);
	$i=0;
	while ($row2=$res2->fetch_assoc()) {
      $month_id = $row2['month_id'];
      $amount = $row2['amount'];
      $last_date = $row2['last_date'];
      $fine_id = $row2['fine_id'];
      $month = $row2['month'];
      $fine_amount = $row2['fine_amount'];
      $sql3 = "SELECT `student_id`, `month_id`, `status`, `class_id` FROM `fees_payment_history` WHERE `student_id`='$student_id' AND `month_id`='$month_id' AND `class_id`='$class_id'";
      $res3=$mains->sendQueryAndGetResult($sql3);
      $nr = $res3->num_rows;
      if($nr==''){
         $details[$i]['student_id']=$student_id;
         $details[$i]['class_id']=$class_id;
         $details[$i]['month_id']=$month_id;
         $details[$i]['amount']=$amount;
         $details[$i]['last_date']=$last_date;
         $details[$i]['fine_id']=$fine_id;
         $details[$i]['fine_amount']=$fine_amount;
         $details[$i]['month']=$month;
         $i=$i+1;
      }
	}
//print_r($details);
}else{
	  $response["success"] = 0;
      $response["message"] = "Failed to connect. Please try again.";
	  echo json_encode($response);
	  exit();
}
if(sizeof($details)==0){
      $response["success"] = 0;
      $response["message"] = "No Due.";
}else{
	$response["success"] = 1;
	for($j=0;$j<sizeof($details);$j++){
	$student_id=$details[$j]['student_id'];
	$month_id =$details[$j]['month_id'];
	$class_id =$details[$j]['class_id'];
	$amount =$details[$j]['amount'];
	$last_date =$details[$j]['last_date'];
	$fine_id =$details[$j]['fine_id'];
	$fine_amount =$details[$j]['fine_amount'];
	$month =$details[$j]['month'];
	$sql4="SELECT  `amount` FROM `discount` WHERE `student_id`='$student_id' AND `month_id`='$month_id'";
	$data = array();
	$res4=$mains->sendQueryAndGetResult($sql4);
	if( $res4){
		$nrd=$res4->num_rows;
		if($nrd>0){
			$row4=$res4->fetch_assoc();
			$discount=$row4['amount'];
		}else{
			$discount=0;
		}
		$date1=date_create(date("Y-m-d"));
        //echo $date1;
        $date2=date_create($last_date);
        $diff=date_diff($date1,$date2);
        $val= $diff->format("%R");
        if($val == '+'){
        	$amount = $amount - $discount;
        	$fine_amount = 0;
        }else{
        	$amount = ($amount+$fine_amount)-$discount;
        }


	}

	$data['month']=$month;
	$data['amount']=$amount;
	$data['fine_amount']=$fine_amount;
	$data['discount']=$discount;
	$data['last_date']=strtotime($last_date);
	$data['class_id']=$class_id;
	$data['month_id']=$month_id;array_push($response['data'], $data);
 }
}

echo json_encode($response);