<?php
//ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$filename = $_FILES['image']['name'];
$file_tmp =$_FILES['image']['tmp_name'];
$institute_id =$_POST['institute_id'];
$class =$_POST['class'];
$section =$_POST['section'];
$teacher_id =$_POST['teacher_id'];
$subject =$_POST['subject'];
$title =$_POST['title'];
$description =$_POST['description'];
$HW_date =$_POST['HW_date'];
$submission_date =$_POST['submission_date'];
$fname = "uploads/".$filename;
$homework_id = $institute_id."_".$class."_".$section."_".$subject."_".$teacher_id;

if(move_uploaded_file($file_tmp,$fname)){
	
	$sql1="INSERT INTO `homework`(`sl_no`, `institute_id`, `class`, `section`, `teacher_id`,`subject`, `title`, `description`, `HW_date`, `submission_date`, `image_link`) VALUES (NULL,'$institute_id','$class','$section','$teacher_id','$subject','$title','$description','$HW_date','$submission_date','$fname')";
	$res1=$mains->sendQueryAndGetResult($sql1);
	if($res1){
        $response["success"] = 1;
        $response["message"] = "Homework uploaded.";
	    echo json_encode($response);   			
    }else{
		$response["success"] = 0;
        $response["message"] = "Failed to upload data. Please try again.";
	    echo json_encode($response);
	}
	
}else{
	$response["success"] = 0;
    $response["message"] = "Failed to upload image. Please try again.";
	echo json_encode($response);
}

?>
