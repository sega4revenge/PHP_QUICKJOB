<?php
	define('HOST','localhost');
	define('USER','quickjobgaa1bb');
	define('PASS','7c066c0f70c94c23');
	define('DB','quickjob_ga_a1bb');
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('unable to connect to db');
 	$mang =array();
	if(isset($_POST['uid'])){
		 
		$uid =$_POST['uid'];
		$sql ="SELECT * FROM volleyupload WHERE name = '$uid'";
		$res = mysqli_query($con,$sql);
		$cout = mysqli_num_rows($res);
		$mang["avata"]="";
		if($cout>0)
		{
			$row=mysqli_fetch_array($res);
                        $mang["avata"]=$row['photo'];   
		} 
		$sql2="SELECT * FROM chitiet_nguoitimviec WHERE unique_id = '$uid'";
		$res2 = mysqli_query($con,$sql2);
		$cout2 = mysqli_num_rows($res2);
		if($cout2>0)
		{
			$row=mysqli_fetch_array($res2);
			$mang["success"]=1;
			$mang["name"]=$row['hoten'];
			$mang["birthdate"]=$row['ngaysinh'];
			$mang["email"]=$row['email'];
			$mang["phone"]=$row['sdt'];
			$mang["sex"]=$row['gioitinh'];
			$mang["andress"]=$row['diachi'];
			$mang["homeless"]=$row['quequan'];

		}else{
		$mang["success"]=0;
		}	
		
		echo json_encode($mang);
		mysqli_close($con);
	}else{
		echo "Error";
	}

