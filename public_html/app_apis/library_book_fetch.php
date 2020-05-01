<?php
//ibrary_book_fetch.php	class_name	success, details, book_id, name, author
include 'include/main.php';
$mains=new Maincls();
$class_name =$_POST['class_name'];

$sql1="SELECT `book_id`, `name`, `description`, `author`, `class_id`, `price`, `status`, `type`, `file_name`, `year`, `total_copies`, `issued_copies`, `barcode` FROM `book` WHERE `class_id` =(SELECT class.class_id FROM class WHERE class.name = '$class_name') AND `total_copies` > `issued_copies`";



$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["book_id"] = $row['book_id'];
		   $details["name"] = $row['name'];
		   $details["author"] = $row['author'];
	      
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