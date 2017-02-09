<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['uid'])) {
	  $uid=$_POST['uid'];
      $qr="SELECT * FROM luucv WHERE unique_id LIKE '$uid'";
	
        $r = mysqli_query($con, $qr);
		while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
		{
			$macv=$row["macv"];
			$rrr=mysqli_query($con,"SELECT * FROM tintuyendung_vieclam WHERE macv = '$macv'");
			$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
			$matd=$rowss['matd'];
			$ccc=mysqli_query($con,"SELECT * FROM tintuyendung WHERE matd = '$matd'");
			$raws=mysqli_fetch_array($ccc, MYSQL_ASSOC);
			$idtuyendung=$raws['unique_id'];
			$sss=mysqli_query($con,"SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$idtuyendung'");
			$raw=mysqli_fetch_array($sss, MYSQL_ASSOC);
			$tenct=$raw["tencongty"];
			$motact=$raw["mota"];
			$ss=mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$idtuyendung'");
			$rss=mysqli_fetch_array($ss, MYSQL_ASSOC);
			$oo=mysqli_query($con,"SELECT * FROM users WHERE unique_id = '$idtuyendung'");
			$roo=mysqli_fetch_array($oo, MYSQL_ASSOC);
		   		
			array_push($mang, new congviec($macv,$rowss["tencv"],$tenct,$rowss["mucluong"],$rowss["diadiem"],$rowss["hannophoso"],$rowss['motacv'],$rowss["bangcap"],$rowss["dotuoi"],$rowss["ngoaingu"],$rowss["gioitinh"],$rowss["yeucaukhac"],$rowss['tenkynang'],$rss["photo"],$roo['phone'],$motact));
		}
			 mysqli_close($con);
		echo json_encode($mang);
		} 
	 
	  
class congviec{
	var $macv;
	var $matd;
	var $tencv;
	var $tenct;
	var $mucluong;
	var $diadiem;
	var $hannophoso;
	var $bangcap;
	var $dotuoi;
	var $ngoaingu;
	var $gioitinh;
	var $khac;
	var $motacv;
	var $kynang;
	var $img;
	var $phone;
	var $motact;
	function congviec($i,$t,$ct,$m,$dd,$g,$motacv,$bc,$age,$nn,$sex,$khac,$kn,$img,$phone,$motact){
		$this->phone=$phone;
		$this->macv=$i;
		$this->motact=$motact;
		$this->matd=$dd;
		$this->tencv=$t;
		$this->tenct=$ct;
		$this->mucluong=$m;
		$this->diadiem=$dd;
		$this->hannophoso=$g;
		$this->dotuoi=$age;
		$this->ngoaingu=$nn;
		$this->gioitinh=$sex;
		$this->khac=$khac;
		$this->bangcap=$bc;
		$this->motacv=$motacv;
		$this->kynang=$kn;
		$this->img=$img;
    }
}