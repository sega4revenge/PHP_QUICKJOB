<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['id'])) {
	  $id=$_POST['id'];
	
	  
 	   	$qrs="SELECT * FROM chitiet_nguoitimviec WHERE unique_id = '$id'";
            	$rs = mysqli_query($con, $qrs);
	  	if(mysqli_num_rows($rs)>0)
	  	 {
			
				$img="";
				$sss = mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$id'");
				if(mysqli_num_rows($sss )>0)
	  			 {
					$raws = mysqli_fetch_array($sss, MYSQL_ASSOC);
					$img=$raws['photo'];
				 }
				$rowss=mysqli_fetch_array($rs, MYSQL_ASSOC);
				array_push($mang, new chitiethoso($rowss["hoten"],$rowss["gioitinh"],$rowss["ngaysinh"],$rowss["email"],$rowss["sdt"],$rowss["diachi"],$rowss["quequan"],$img));
			
				 mysqli_close($con);
	  	 }
		echo json_encode($mang);
	   }

	 
class chitiethoso{
	var $hoten;
	var $gioitinh2;
	var $ngaysinh;
	var $email;
	var $sdt;
	var $diachi;
	var $quequan;
	var $img;
	function chitiethoso($hoten,$gioitinh2,$ngaysinh,$email,$sdt,$diachi,$quequan,$img){
		$this->img=$img;
		$this->hoten=$hoten;
		$this->gioitinh2=$gioitinh2;
		$this->ngaysinh=$ngaysinh;
		$this->email=$email;
		$this->sdt=$sdt;
		$this->diachi=$diachi;
		$this->quequan=$quequan;
    }
}