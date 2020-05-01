
<?php
//library_book_request.php	book_id, student_id, issue_start_date, issue_end_date	success
include 'include/main.php';
$mains=new Maincls();
$book_id =$_POST['book_id'];
$student_id =$_POST['student_id'];
$issue_start_date =$_POST['issue_start_date'];
$issue_end_date =$_POST['issue_end_date'];

$sql1="INSERT INTO `book_request`(`book_request_id`, `book_id`, `student_id`, `issue_start_date`, `issue_end_date`, `status`) VALUES (NULL,'$book_id','$student_id','$issue_start_date','$issue_end_date','0')";



$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
		$response["success"] = 1;
        $response["message"] = "success";
		echo json_encode($response);
		     			
}else{
      $response["success"] = 0;
      $response["message"] = "Failed to connect. Please try again.";
	  echo json_encode($response);
}

?>