<?php
//ini_set("display_errors",1);
//class_section_list_version_control.php
//v [GET]
//student_routine_fetch.php	v [GET]	success, details, class_name, section_name, subject_name, teacher_name, start_time, end_time, day


include 'include/main.php';
$mains=new Maincls();
$version =$_GET['v'];
$response=array();
$db_v=0;
$sql1="SELECT `version` FROM `version_control` WHERE `table_name`='routine'";
$res1=$mains->sendQueryAndGetResult($sql1);
if($res1){
	$row=$res1->fetch_assoc();
	$db_v = $row['version'];
	if($version==$db_v){
      
		$response['success']=2;
	    $response['message']="Version Mached.";
	}else{
      
		$response['success']=1;
	    $response['message']="Version not mached.";
	    $response['version']=$db_v;
	    $response['details']=array();
	    $sql_cls="SELECT `day`, `time_start`,`time_end`,`time_start_min`,`time_end_min`,`amend`,`amstart`,teacher.first_name,subject.name,teacher.last_name,class.name as cname , section.name as sname FROM `class_routine` INNER JOIN teacher ON teacher.teacher_id = class_routine.teacher_id INNER JOIN subject ON subject.subject_id = class_routine.subject_id INNER JOIN class ON class.class_id = class_routine.class_id INNER JOIN section ON section.section_id = class_routine.section_id";
	    $res_cls=$mains->sendQueryAndGetResult($sql_cls);
	    
	    while ($rowc=$res_cls->fetch_assoc()) {
	       $details['day'] = $rowc['day'];
	       $details['start_time'] = $rowc['time_start'].":".$rowc['time_start_min']." ".$rowc['amstart'];
	       $details['end_time'] = $rowc['time_end'].":".$rowc['time_end_min']." ".$rowc['amend'];
	       $details['teacher_name'] = $rowc['first_name']." ".$rowc['last_name'];
	       $details['subject_name'] = $rowc['name'];
	       $details['section_name'] = $rowc['sname'];
	       $details['class_name'] = $rowc['cname'];
		   
		   array_push($response["details"], $details);
		}
	}
}else{
	$response['success']=0;
	$response['message']="Please try again.";
}
echo json_encode($response);


?>