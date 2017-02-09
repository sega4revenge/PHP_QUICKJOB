<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['textkey']) && isset($_POST['diadiem'])) {
	  $dd=$_POST['textkey'];
	  $ds=$_POST['diadiem'];
	  
       $qr="SELECT * FROM tintuyendung_vieclam WHERE diadiem LIKE '%$dd%' AND tencv LIKE '%$ds%'";
	
        $r = mysqli_query($con, $qr);
		while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
		{
			$matd=$row["matd"];
			$macv=$row["macv"];
			$motacv=$row["motacv"];
			$rr = mysqli_query($con,"SELECT * FROM tintuyendung WHERE matd = '$matd'");
			$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
			$getid=$rows["unique_id"];
			$rrr=mysqli_query($con,"SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$getid'");
			$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
			$tenct=$rowss["tencongty"];
			$motact=$rowss["mota"];
			$ss=mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$getid'");
			$rss=mysqli_fetch_array($ss, MYSQL_ASSOC);
			$fist=mysqli_query($con,"SELECT * FROM users WHERE unique_id = '$getid'");
			$rfist=mysqli_fetch_array($fist, MYSQL_ASSOC);
			$sdt = $rfist["phone"];
		 	
			array_push($mang, new congviec($row["macv"],$row["tencv"],$tenct,$row["mucluong"],$row["diadiem"],$row["hannophoso"],$motacv,$row["bangcap"],$row["dotuoi"],$row["ngoaingu"],$row["gioitinh"],$row["yeucaukhac"],$row['tenkynang'],$rss["photo"],$motact,$sdt));
		}
			 mysqli_close($con);
		echo json_encode($mang);
		} 
	 
	  
class congviec{
	var $macv;
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
	var $motact;
	var $sdtct;
	function congviec($i,$t,$ct,$m,$dd,$g,$motacv,$bc,$age,$nn,$sex,$khac,$kn,$img,$motact,$sdtct){
		$this->motact=$motact;
		$this->sdtct=$sdtct;
		$this->macv=$i;
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