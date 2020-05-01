<?php
//ini_set("display_errors",1);
//class_section_list_version_control.php
//v [GET]
//success, version, class_list, section_list

include 'include/main.php';
$mains=new Maincls();
$version =$_GET['v'];
$response=array();
$db_v=0;
$sql1="SELECT `version` FROM `version_control` WHERE `table_name` ='class and section'";
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
	    $response['class_list']=array();
	    $response['section_list']=array();
	    $sql_cls="SELECT  `name` FROM `class`";
	    $sql_sec="SELECT DISTINCT `name` FROM `section`";
	    $res_cls=$mains->sendQueryAndGetResult($sql_cls);
	    $res_sec=$mains->sendQueryAndGetResult($sql_sec);
	    while ($rowc=$res_cls->fetch_assoc()) {
	       $details = $rowc['name'];
		   
		   array_push($response["class_list"], $details);
		}
		while ($rows=$res_sec->fetch_assoc()) {
	       $details = $rows['name'];
		   
		   array_push($response["section_list"], $details);
		}
	}
}else{
	$response['success']=0;
	$response['message']="Please try again.";
}
echo json_encode($response);


?>