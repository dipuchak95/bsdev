 <?php
//ini_set("display_errors",1);
include 'include/main.php';
$current_date_time = (date("Y-m-d",time()));
$homework_code=hash('crc32', (date("Y-m-d",time())));
$mains=new Maincls();
$filename = $_FILES['image']['name'];
$file_tmp =$_FILES['image']['tmp_name'];
$title =$_POST['title'];
$description =$_POST['description'];
$class_id =$_POST['class_id'];
$subject_id =$_POST['subject_id'];
$uploader_id =$_POST['uploader_id'];
$time_end =$_POST['time_end'];
$section_id =$_POST['section_id'];
$uploader_type ="Teacher";
$file_name =$_POST['file_name'];
$date_end =$_POST['date_end'];
$type =$_POST['type'];
$user ="Teacher";
$status =$_POST['status'];
$year =$_POST['year'];
$publish_date =$_POST['publish_date'];
$class = 0;
$section = 0;

$sql0 = "SELECT *  FROM `class` INNER JOIN section ON class.class_id = section.class_id WHERE class.`name` = '$class_id' AND section.name = '$section_id'";
$res0=$mains->sendQueryAndGetResult($sql0);
if($res0){
	$numRows=$res0->num_rows;
	if($numRows>0){
		while ($row=$res0->fetch_assoc()) {
	      $section =  $row['section_id'];
		  $class = $row['class_id'];
		 
	    }
	}
}

$fname = "../uploads/homework/".$filename;
if(move_uploaded_file($file_tmp,$fname)){
	$sql1="INSERT INTO `homework`(`homework_id`, `homework_code`, `title`, `description`, `class_id`, `subject_id`, `uploader_id`, `time_end`, `section_id`,`uploader_type`, `file_name`, `date_end`, `type`, `user`, `status`, `year`, `filesize`, `wall_type`, `publish_date`, `upload_date`) VALUES (NULL,'$homework_code','$title','$description','$class','0',(SELECT teacher.teacher_id FROM teacher WHERE teacher.username = '$uploader_id'),'$time_end','$section','$uploader_type','$fname','$date_end','$type','$user','$status','$year','','Homework','$publish_date','$current_date_time')";

	$res1=$mains->sendQueryAndGetResult($sql1);
	if($res1){
        $response["success"] = 1;
        $response["message"] = "Homework uploaded.";
	    echo json_encode($response);   			
    }else{
		$response["success"] = 0;
        $response["message"] = "Failed to upload data. Please try again.";
        //$response["sql"] = $sql1;
	    echo json_encode($response);
	}
}else{
	$response["success"] = 0;
    $response["message"] = "Failed to upload image. Please try again.";
	echo json_encode($response);
}



?>

