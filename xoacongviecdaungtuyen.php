<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['idungtuyen'])  ) {
		  $idut=$_POST['idungtuyen'];

		$sss = mysqli_query($con,"DELETE FROM hoso_ungtuyen WHERE id_ungtuyen = '$idut'");
		
			
		$response["error"] = false;
    		$response["success"] =1;
    		$response["msg"] = "Xóa thành công!";
		echo json_encode($response);
		
		} 
	 
