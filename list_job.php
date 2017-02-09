<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['id']) )
	{
	   $id=$_POST['id'];
       $qr="SELECT * FROM tintuyendung WHERE unique_id = '$id'";
       $r = mysqli_query($con, $qr);
	   if(mysqli_num_rows($r)>0)
	   {
		 
			while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
			{
				$matd=$row['matd'];
				$rr = mysqli_query($con,"SELECT * FROM tintuyendung_vieclam WHERE matd = '$matd'");
				$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
				$rrr=mysqli_query($con,"SELECT * FROM chitiet_nhatuyendung WHERE unique_id = '$id'");
				$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
				$ss=mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$id'");
				$rss=mysqli_fetch_array($ss, MYSQL_ASSOC);
				$rrs = mysqli_query($con,"SELECT * FROM users WHERE unique_id = '$id'");
				$rws = mysqli_fetch_array($rrs, MYSQL_ASSOC);
		
				$success=0;
				array_push($mang, new congviec($success,$rows["macv"],$matd,$rows["tencv"],$rowss['tencongty'],$rowss['diachi'],$rowss['quymo'],$rowss['nganhnghe'],$rowss['mota'],$rows["nganhNghe"],$rows["chucdanh"],$rows["soluong"],$rows["mucluong"],$rows["diadiem"],$rows["hannophoso"],$rows["motacv"],$rows["bangcap"],$rows["dotuoi"],$rows["ngoaingu"],$rows["gioitinh"],$rows["yeucaukhac"],$rows["tenkynang"],$rss["photo"],$rows["phucloi"]));
			}
			 mysqli_close($con);
	    }else{
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
					$success=1;
					array_push($mang, new chitietnhatuyendung($success,$row["tencongty"],$row["quymo"],$row["diachi"],$row["nganhnghe"],$row["mota"],$img));
				}
					 mysqli_close($con);
			 }

		}
			
		echo json_encode($mang);
		} 
	 
	  
class congviec{
	var $status;
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
	var $diachi;
	var $nganhnghe;
	var $motact;
	var $quymo;
	var $nn;
	var $chucdanh;
	var $soluong;
	var $phucloi;
	function congviec($status,$i,$matd,$t,$ct,$dc,$qm,$n,$motact,$nganhnghe,$chucdanh,$soluong,$m,$dd,$g,$motacv,$bc,$age,$nn,$sex,$khac,$kn,$img,$phucloi){
		$this->macv=$i;
		$this->status=$status;
		$this->matd=$matd;
		$this->tencv=$t;
		$this->quymo=$qm;
		$this->diachi=$dc;
		$this->nganhnghe=$n;
		$this->motact=$motact;
		$this->nn=$nganhnghe;
		$this->chucdanh=$chucdanh;
		$this->soluong=$soluong;
		$this->phucloi=$phucloi;
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
class chitietnhatuyendung{
	var $status;
	var $tenct;
	var $quymo;
	var $diachi;
	var $nganhnghe;
	var $motact;
	var $img;
	function chitietnhatuyendung($status,$tenct,$quymo,$diachi,$nganhnghe,$motact,$img){
		$this->status=$status;
		$this->tenct=$tenct;
		$this->quymo=$quymo;
		$this->diachi=$diachi;
		$this->nganhnghe=$nganhnghe;
		$this->motact=$motact;
		$this->img=$img;
		
    }
}
