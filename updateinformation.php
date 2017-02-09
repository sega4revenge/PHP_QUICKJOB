<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
 //   
    if(isset($_POST['uniqueid'])||isset($_POST['name'])||isset($_POST['email'])||isset($_POST['age'])||isset($_POST['phone'])||isset($_POST['location'])) {
	  $name=$_POST['name'];
	  $email=$_POST['email'];
	  $age=$_POST['age'];
	  $phone=$_POST['phone'];
	  $location=$_POST['location'];  
	  $uid=$_POST['uniqueid'];
		$kq=0;
	    $qrs="SELECT *  FROM chitiet_nguoitimviec WHERE unique_id = '$uid'";
		$rs = mysqli_query($con, $qrs);
		if(mysqli_num_rows($rs)>0)
		{
			$ar="UPDATE chitiet_nguoitimviec SET hoten = '$name',ngaysinh = '$age',email = '$email',sdt = '$phone',diachi = '$location' WHERE unique_id= '$uid'";
			$ra = mysqli_query($con, $ar);
			$kq=1;
			
		}else{
			 $uuid=uniqid('', true);
			 $qr="INSERT INTO chitiet_nguoitimviec(ID_user,unique_id,hoten,gioitinh,ngaysinh,email,sdt,diachi,quequan) VALUES('$uuid','$uid','$name','','$age','$email','$phone','$location','')";
       		 	 $r = mysqli_query($con, $qr);
			 $kq=2;
		}
		echo $kq;
} 
	
	
	  
