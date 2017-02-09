<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
   	 $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');    
    if(true) {
	
	  
       $qr="SELECT * FROM tintuyendung_vieclam  ";
	
        $r = mysqli_query($con, $qr);
		while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
		{
			$matd=$row["matd"];
				$macv=$row["macv"];
				$motacv=$row["motacv"];
				$rr = mysqli_query($con,"SELECT * FROM tintuyendung WHERE matd = '$matd'");
				$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
				$getid=$rows["unique_id"];
				$rrs = mysqli_query($con,"SELECT * FROM users WHERE unique_id = '$getid'");
				$rws = mysqli_fetch_array($rrs, MYSQL_ASSOC);
				$rrr=mysqli_query($con,"SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$getid'");
				$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
				$tenct=$rowss["tencongty"];
				$ss=mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$getid'");
				$rss=mysqli_fetch_array($ss, MYSQL_ASSOC);
				$loca = mysqli_query($con,"SELECT * FROM locations WHERE macv = '$macv'");
				$rloca = mysqli_fetch_array($loca, MYSQL_ASSOC);
				$lat=$rloca['latitude'];
				$lng=$rloca['longitude'];
				array_push($mang, new congviec($row["macv"],$row["tencv"],$tenct,$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$row["mucluong"],$row["diadiem"],$row["hannophoso"],$motacv,$row["bangcap"],$row["dotuoi"],$row["ngoaingu"],$row["gioitinh"],$row["yeucaukhac"],$row['tenkynang'],$rss["photo"],$rws["phone"],$lat,$lng));

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
	var $sdt;
	var $diachi;
	var $quymo;
	var $nganhnghe;
	var $motact;
	var $lat;
	var $lng;
	function congviec($i,$t,$ct,$dc,$qm,$nganhnghe,$mota,$m,$dd,$g,$motacv,$bc,$age,$nn,$sex,$khac,$kn,$img,$sdt,$lat,$lng){
		$this->sdt=$sdt;
		$this->diachi=$dc;
		$this->lat=$lat;
		$this->lng=$lng;
		$this->quymo=$qm;
		$this->nganhnghe=$nganhnghe;
		$this->motact=$mota;
		$this->macv=$i;
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