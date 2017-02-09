<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
   	$mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');

 //   
    if(isset($_POST['uniqueid'])||isset($_POST['name'])||isset($_POST['diachi'])||isset($_POST['mota'])||isset($_POST['phone'])) {
	  $name=$_POST['name'];
	  $diachi=$_POST['diachi'];
	  $mota=$_POST['mota'];
	  $phone=$_POST['phone'];
	  $uid=$_POST['uniqueid'];
			$kq=0;
	    $qrs="SELECT *  FROM chitiet_nhatuyendung WHERE unique_id = '$uid'";
		$rs = mysqli_query($con, $qrs);
		if(mysqli_num_rows($rs)>0)
		{
			$ar="UPDATE chitiet_nhatuyendung SET tencongty = '$name',diachi = '$diachi',mota = '$mota' WHERE unique_id= '$uid'";
			$ra = mysqli_query($con, $ar);
			$ar="UPDATE users SET phone = '$phone' WHERE unique_id= '$uid'";
			$ra = mysqli_query($con, $ar);
			$kq=1;
			
		}else{
			 $qr="INSERT INTO chitiet_nhatuyendung(unique_id,tencongty,quymo,diachi,nganhnghe,mota) VALUES('$uid','$name','','$diachi','','$mota')";
       		 $r = mysqli_query($con, $qr);
			 $kq=2;
		}
		echo $kq; 
	}else{
	$response["success"] = 0;
  
			$response["error"] = TRUE;
    
			$response["error_msg"] = "Required parameters email or password is missing!";
    
			echo json_encode($response);

}
	
	
	  
