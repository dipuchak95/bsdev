<?php
//library_issued_book_fetch.php	student_id	
//success, details, name, author, issue_start_date, issue_end_date
include 'include/main.php';
$mains=new Maincls();
$student_id =$_POST['student_id'];

$sql1="SELECT `issue_start_date`, `issue_end_date`, book.name,book.author FROM `book_request` INNER JOIN book ON book.book_id = book_request.book_id WHERE `student_id` = '$student_id' AND book_request.`status` != 0";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["name"] = $row['name'];
		   $details["author"] = $row['author'];
		   $details["issue_start_date"] = $row['issue_start_date'];
		   $details["issue_end_date"] = $row['issue_end_date'];
	      
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

?>