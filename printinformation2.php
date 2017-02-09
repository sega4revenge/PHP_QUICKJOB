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
 
 	   	$qrs="SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$id'";
            	$rs = mysqli_query($con, $qrs);
	  	if(mysqli_num_rows($rs)>0)
	  	 {
			 
			while($row = mysqli_fetch_array($rs, MYSQL_ASSOC))
			{
				$img="";
				$sss = mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$id'");
				if(mysqli_num_rows($sss )>0)
	  			 {
					$raws = mysqli_fetch_array($sss, MYSQL_ASSOC);
					$img=$raws['photo'];
				 }
				$q="SELECT * FROM users WHERE unique_id = '$id'";
            	$r = mysqli_query($con, $q);
				$ra = mysqli_fetch_array($r, MYSQL_ASSOC);
				$sdt=$ra['phone'];
				array_push($mang, new chitietnhatuyendung($row["tencongty"],$row["quymo"],$row["diachi"],$row["nganhnghe"],$row["mota"],$sdt,$img));
			}
				 mysqli_close($con);
	  	 }
		echo json_encode($mang);
	   }

	 
class chitietnhatuyendung{
	var $tencongty;
	var $mota;
	var $sdt;
	var $diachi;
	var $img;
	var $quymo;
	var $nganhnghe;
	function chitietnhatuyendung($tencongty,$quymo,$diachi,$nganhnghe,$mota,$sdt,$img){
		$this->img=$img;
		$this->quymo=$quymo;
		$this->nganhnghe=$nganhnghe;
		$this->tencongty=$tencongty;
		$this->mota=$mota;
		$this->sdt=$sdt;
		$this->diachi=$diachi;
    }
}