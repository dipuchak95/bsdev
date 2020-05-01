<?php
ini_set("display_errors",1);
include 'include/main.php';
$mains=new Maincls();
$filename = $_FILES['image']['name'];
$file_tmp =$_FILES['image']['tmp_name'];
$exam_name =$_POST['exam_name'];
$subject_name =$_POST['subject_name'];
$institute_id =$_POST['institute_id'];
$teacher_id =$_POST['teacher_id'];
$publish_date =$_POST['publish_date'];
$section =$_POST['section'];
$class =$_POST['class'];
$session =$_POST['session'];
$type =$_POST['type'];
$fname = "uploads/".$filename;

if(move_uploaded_file($file_tmp,$fname)){
	
	$sql1="INSERT INTO `syllabus_details`(`sl_no`, `exam_name`, `subject_name`, `institute_id`, `teacher_id`, `publish_date`, `syllabus_link`, `section`, `class`, `session` , `type`) VALUES (NULL,'$exam_name','$subject_name','$institute_id','$teacher_id','$publish_date','$fname','$section','$class','$session','$type')";
	$res1=$mains->sendQueryAndGetResult($sql1);
	if($res1){
        $response["success"] = 1;
        $response["message"] = "Syllabus uploaded.";
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
