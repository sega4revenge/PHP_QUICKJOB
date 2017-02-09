<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
   	 $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');    
    if(isset($_POST['macv'])) {
			$macv = $_POST['macv'];
			$rr = mysqli_query($con,"SELECT * FROM tintuyendung_vieclam WHERE macv = '$macv'");
			$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
			$matd=$rows['matd'];
			$qr="SELECT * FROM tintuyendung WHERE matd = '$matd'";
			$r = mysqli_query($con, $qr);
			$row2 = mysqli_fetch_array($r, MYSQL_ASSOC);
			$uid = $row2['unique_id'];
			$qr2="SELECT * FROM tintuyendung WHERE unique_id = '$uid'";
			$r2 = mysqli_query($con, $qr2);
			while($row = mysqli_fetch_array($r2, MYSQL_ASSOC))
			{
				$matd=$row["matd"];
				$getid=$row["unique_id"];
				$views=$row["views"];
				$rr = mysqli_query($con,"SELECT * FROM tintuyendung_vieclam WHERE matd = '$matd'");
				$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
				$macv=$rows["macv"];
				$motacv=$rows["motacv"];
				
				$rrs = mysqli_query($con,"SELECT * FROM users WHERE unique_id = '$getid'");
				$rws = mysqli_fetch_array($rrs, MYSQL_ASSOC);
				$rrr=mysqli_query($con,"SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$getid'");
				$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
				$tenct=$rowss["tencongty"];
				$ss=mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$getid'");
				$rss=mysqli_fetch_array($ss, MYSQL_ASSOC);	
				array_push($mang, new congviec($macv,$matd,$views,$rows["tencv"],$tenct,$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$rows["mucluong"],$rows["diadiem"],$rows["hannophoso"],$motacv,$rows["bangcap"],$rows["dotuoi"],$rows["ngoaingu"],$rows["gioitinh"],$rows["yeucaukhac"],$rows['tenkynang'],$rss["photo"],$rws["phone"],"","",""));
			}

		
		
			 mysqli_close($con);
		echo json_encode($mang);
		} 
	 
	  
class congviec{
	var $macv;
	var $views;
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
	var $long;
	var $ngaydang;
	function congviec($i,$matd,$views,$t,$ct,$dc,$qm,$nganhnghe,$mota,$m,$dd,$g,$motacv,$bc,$age,$nn,$sex,$khac,$kn,$img,$sdt,$lat,$long,$ngaydang){
		$this->sdt=$sdt;
		$this->ngaydang=$ngaydang;
		$this->diachi=$dc;
		$this->lat=$lat;
		$this->long=$long;
		$this->views=$views;
		$this->quymo=$qm;
		$this->nganhnghe=$nganhnghe;
		$this->motact=$mota;
		$this->macv=$i;
		$this->matd=$matd;
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