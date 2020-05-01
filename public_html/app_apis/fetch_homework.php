<?php
ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();



$class_name =$_POST['class_name'];
$section_name =$_POST['section_name'];
//$type =$_POST['type'];
//$serial_no =$_POST['serial_no'];

$sql0 = "SELECT *  FROM `class` INNER JOIN section ON class.class_id = section.class_id WHERE class.`name` = '$class_name' AND section.name = '$section_name'";
//echo $sql0;
$res1=$mains->sendQueryAndGetResult($sql0);
if($res1){
	$numRows=$res1->num_rows;
	if($numRows>0){
		while ($row=$res1->fetch_assoc()) {
	      $class_id =  $row['class_id'];
		  $section_id = $row['section_id'];
		  $sql1="SELECT `homework_id`, `homework_code`, `title`, `description`, homework.`class_id`, homework.`subject_id`, `uploader_id`, `time_end`, homework.`section_id`, `uploader_type`, `file_name`, `date_end`, homework.`type`, `user`, `status`, homework.`year`, `filesize`, `wall_type`, `publish_date`, `upload_date`,teacher.first_name,teacher.last_name , subject.name FROM `homework` INNER JOIN teacher ON teacher.teacher_id = homework.uploader_id INNER JOIN subject ON subject.subject_id = homework.subject_id WHERE  homework.`class_id` = '$class_id' AND homework.`section_id` = '$section_id'";
		  //`type` = '' AND
          $res1=$mains->sendQueryAndGetResult($sql1);
          if($res1){
	        $numRows=$res1->num_rows;
	        if($numRows>0){
		         $response["success"] = 1;
                 $response["message"] = "success";
		         $response["details"] = array();
		         while ($row=$res1->fetch_assoc()) {
	                 $details["homework_id"] = $row['homework_id'];
	                 $details["name"] = $row['first_name']." ".$row['first_name'];
					 $details["homework_code"] = $row['homework_code'];
					 $details["title"] = $row['title'];
					 $details["description"] = $row['description'];
					 $details["class_id"] = $row['class_id'];
					 $details["subject_id"] = $row['subject_id'];
					 $details["uploader_id"] = $row['uploader_id'];
					 $details["time_end"] = $row['time_end'];
					 $details["section_id"] = $row['section_id'];
					 $details["uploader_type"] = $row['uploader_type'];
					 $details["file_name"] = $row['file_name'];
					 $details["date_end"] = $row['date_end'];
					 $details["type"] = $row['type'];
					 $details["user"] = $row['user'];
					 $details["status"] = $row['status'];
					 $details["year"] = $row['year'];
					 $details["filesize"] = $row['filesize'];
					 $details["wall_type"] = $row['wall_type'];
					 $details["publish_date"] = $row['publish_date'];
					 $details["upload_date"] = $row['upload_date'];
					 $details["subject_name"] = $row['name'];
					 
	       
		             array_push($response["details"], $details);
		            }
		        echo json_encode($response);
	        }else{
               $response["success"] = 0;
               $response["message"] = "Failed to fetch data. Please try again.";
	           echo json_encode($response);
            }

    }else{
      $response["success"] = 0;
      $response["message"] = "Failed to connect. Please try again.";
	  echo json_encode($response);
}
		 
	    }
	}
}

/*
*/
?>

