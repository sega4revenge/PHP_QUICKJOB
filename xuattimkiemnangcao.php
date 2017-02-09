<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
  	
    if(isset($_POST['nganhnghe']) || isset($_POST['diadiem']) || isset($_POST['mucluong']) || isset($_POST['page'])) {
	 
	  $nganhnghe=$_POST['nganhnghe'];
	  $diadiem=$_POST['diadiem'];
	  $luong=$_POST['mucluong'];
	  $page=$_POST['page'];
	  $page2=$page*10;
	  if($nganhnghe=="")
	  {
	    	$qr="SELECT * FROM tintuyendung_vieclam  WHERE diadiem LIKE '%$diadiem%' AND mucluong LIKE '%$luong%' AND nganhNghe LIKE '%$nganhnghe%' ORDER BY ngaydang DESC LIMIT $page2,10";		
          }else {
			$qr="SELECT * FROM tintuyendung_vieclam  WHERE diadiem LIKE '%$diadiem%' AND mucluong LIKE '%$luong%' AND nganhNghe LIKE '$nganhnghe' ORDER BY ngaydang DESC LIMIT $page2,10";
		}
      	  $r = mysqli_query($con, $qr);
		if(mysqli_num_rows($r)>0)
		{
			$count=mysqli_num_rows($r);
			$numpage=$count/10;

			if($count<0)
			{
			}else{

			while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
			{
				$matd=$row["matd"];
				$macv=$row["macv"];
				$motacv=$row["motacv"];
				$rr2 = mysqli_query($con,"SELECT * FROM locations WHERE macv = '$macv'");
				$rows2 = mysqli_fetch_array($rr2, MYSQL_ASSOC);
				$lat=$rows2['latitude'];
				$long=$rows2['longitude'];
				$rr = mysqli_query($con,"SELECT * FROM tintuyendung WHERE matd = '$matd'");
				$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
				$getid=$rows["unique_id"];
				$views=$rows["views"];
				$rrs = mysqli_query($con,"SELECT * FROM users WHERE unique_id = '$getid'");
				$rws = mysqli_fetch_array($rrs, MYSQL_ASSOC);
				$rrr=mysqli_query($con,"SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$getid'");
				$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
				$tenct=$rowss["tencongty"];
				$ss=mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$getid'");
				$rss=mysqli_fetch_array($ss, MYSQL_ASSOC);	
				
				array_push($mang , new congviec($macv,$matd,$views,$row["tencv"],$tenct,$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$row["mucluong"],$row["diadiem"],$row["hannophoso"],$motacv,$row["bangcap"],$row["dotuoi"],$row["ngoaingu"],$row["gioitinh"],$row["yeucaukhac"],$row['tenkynang'],$rss["photo"],$rws["phone"],$lat,$long));
			
			}
			}
		
		}
			 mysqli_close($con);
		echo json_encode($mang);
		} else{

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
	function congviec($i,$matd,$views,$t,$ct,$dc,$qm,$nganhnghe,$mota,$m,$dd,$g,$motacv,$bc,$age,$nn,$sex,$khac,$kn,$img,$sdt,$lat,$long){
		$this->sdt=$sdt;
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