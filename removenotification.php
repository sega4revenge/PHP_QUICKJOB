<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['uid']) ||isset($_POST['macv']) ) {
		  $uid=$_POST['uid'];
		  $macv=$_POST['macv'];
		$sss = mysqli_query($con,"DELETE FROM notification WHERE unique_id = '$uid' AND macv = '$macv'");
		
			
		$response["error"] = false;
    		$response["success"] =1;
    		$response["msg"] = "XÃ³a thÃ nh cÃ´ng!";
		echo json_encode($response);
		
		} 
	 
