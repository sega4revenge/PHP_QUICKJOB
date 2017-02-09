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
	 
		$qr="SELECT * FROM notification where unique_id = '$uid'";
        	$r = mysqli_query($con, $qr);
		if(mysqli_num_rows($r)>0)
		{
			while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
			{
				
				$macv=$row["macv"];
				$rr = mysqli_query($con,"SELECT * FROM tintuyendung_vieclam INNER JOIN tintuyendung ON tintuyendung.matd = tintuyendung_vieclam.matd INNER JOIN users ON tintuyendung.unique_id = users.unique_id INNER JOIN chitiet_nhatuyendung ON chitiet_nhatuyendung.unique_id = tintuyendung.unique_id  INNER JOIN volleyupload ON volleyupload.name = tintuyendung.unique_id WHERE tintuyendung_vieclam.macv = '$macv'");
				$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
							
				array_push($mang, new congviec($rows["macv"],$rows["tencv"],$rows['tencongty'],$rows['diachi'],$rows['quymo'],$rows['nganhnghe'],$rows['mota'],$rows["mucluong"],$rows["diadiem"],$rows["hannophoso"],$rows['motacv'],$rows["bangcap"],$rows["dotuoi"],$rows["ngoaingu"],$rows["gioitinh"],$rows["yeucaukhac"],$rows["tenkynang"],$rows["photo"],$rows["phone"],$rows["mota"]));
			}
		
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
	var $mota;
	function congviec($i,$t,$ct,$dc,$qm,$nganhnghe,$mota,$m,$dd,$g,$motacv,$bc,$age,$nn,$sex,$khac,$kn,$img,$sdt,$mota){
		$this->sdt=$sdt;
		$this->mota=$mota;
		$this->diachi=$dc;
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

