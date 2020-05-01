<?php
//ini_set("display_errors",1);
//fetch_gallery.php		success, details, "sl_no":"1","title":"Title","description":"Description","image_link":"https:\/\/i

include 'include/main.php';
$mains=new Maincls();
$student_id =$_POST['student_id'];
$sql1="SELECT `sl_no`, `title`, `description`, `image_link` FROM `gallery`";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		$response["success"] = 1;
        $response["message"] = "success";
		$response["details"] = array();
		while ($row=$res1->fetch_assoc()) {
	       $details["sl_no"] = $row['sl_no'];
		   $details["title"] = $row['title'];
		   $details["description"] = $row['description'];
		   $details["image_link"] = $row['image_link'];
	      
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