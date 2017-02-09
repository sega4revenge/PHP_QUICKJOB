<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
   	 $mang =array();
	 $hot=array();
	 $new=array();
	 $company=array();
	 $near=array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');    
     if(true) {
	
		$location='';        
	$qr="SELECT * FROM tintuyendung ORDER BY views DESC LIMIT 0,3 ";
        $r = mysqli_query($con, $qr);
		while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
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
				array_push($hot, new congviec($macv,$matd,$views,$rows["tencv"],$tenct,$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$rows["mucluong"],$rows["diadiem"],$rows["hannophoso"],$motacv,$rows["bangcap"],$rows["dotuoi"],$rows["ngoaingu"],$rows["gioitinh"],$rows["yeucaukhac"],$rows['tenkynang'],$rss["photo"],$rws["phone"],"","",""));
		}
		$mang['hot']=$hot;
		$qr2="SELECT * FROM tintuyendung_vieclam ORDER BY ngaydang DESC LIMIT 0,3 ";
        $r2 = mysqli_query($con, $qr2);
		while($row = mysqli_fetch_array($r2, MYSQL_ASSOC))
		{
				$matd=$row["matd"];
				$macv=$row["macv"];
				$motacv=$row["motacv"];
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
				array_push($new, new congviec($row["macv"],$matd,$views,$row["tencv"],$tenct,$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$row["mucluong"],$row["diadiem"],$row["hannophoso"],$motacv,$row["bangcap"],$row["dotuoi"],$row["ngoaingu"],$row["gioitinh"],$row["yeucaukhac"],$row['tenkynang'],$rss["photo"],$rws["phone"],"","",$row['ngaydang']));
			}
			$mang['new']=$new;
			
		$qr3="SELECT * FROM tintuyendung_vieclam WHERE diadiem LIKE '%$location%' ORDER BY ngaydang DESC LIMIT 0,3";
       		 $r3 = mysqli_query($con, $qr3);
		while($row = mysqli_fetch_array($r3, MYSQL_ASSOC))
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
				array_push($near, new congviec($macv,$matd,$views,$row["tencv"],$tenct,$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$row["mucluong"],$row["diadiem"],$row["hannophoso"],$motacv,$row["bangcap"],$row["dotuoi"],$row["ngoaingu"],$row["gioitinh"],$row["yeucaukhac"],$row['tenkynang'],$rss["photo"],$rws["phone"],$lat,$long,""));
			
			}
			$mang['near']=$near;


			$qr4="SELECT DISTINCT unique_id FROM tintuyendung ORDER BY views DESC LIMIT 0,10";
       			$r4 = mysqli_query($con, $qr4);
			while($row = mysqli_fetch_array($r4, MYSQL_ASSOC))
			{
				$uid=$row['unique_id'];
				$rrr=mysqli_query($con,"SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$uid'");
				$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
				$ss=mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$uid'");
				$rss=mysqli_fetch_array($ss, MYSQL_ASSOC);	
				array_push($company, new company($uid,$rowss['tencongty'],$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$rss["photo"]));
			}
			$mang['company']=$company;		
		
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
}class company{
	var $namecompany;
	var $diachi;
	var $nganhnghe;
	var $quymo;
	var $mota;
	var $img;
	var $uid;
function company($uid,$namecompany,$diachi,$quymo,$nganhnghe,$mota,$img){
		$this->uid=$uid;
		$this->namecompany=$namecompany;
		$this->diachi=$diachi;
		$this->quymo=$quymo;
		$this->nganhnghe=$nganhnghe;
		$this->mota=$mota;
		$this->img=$img;
}
	
}