<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
 //   
    if(isset($_POST['textkey'])||isset($_POST['nganhnghe'])||isset($_POST['diadiem'])||isset($_POST['tuoi'])||isset($_POST['kinhnghiem'])||isset($_POST['gioitinh']) || isset($_POST['page'])) {
	  $tencv=$_POST['textkey'];
	  $nganhnghe=$_POST['nganh'];
	  $diadiem=$_POST['diadiem'];
	  $tuoi=$_POST['tuoi'];
	  $kinhnghiem=$_POST['kinhnghiem']; 
	  $gioitinh=$_POST['gioitinh'];  
	  $page=$_POST['page'];
	  $page2=$page*10;	 

		$qr="SELECT * FROM chitiet_hoso WHERE (diadiem LIKE '%$diadiem%') AND (nganhnghe LIKE '%$nganhnghe%') AND (namkn LIKE '%$kinhnghiem%') AND  (tencv LIKE '%$tencv%') LIMIT $page2,10 ";
       		 $r = mysqli_query($con, $qr);
		if(mysqli_num_rows($r)>0)
		{
			$countt=mysqli_num_rows($r);
			$numpage=$countt/10;
			if($countt<0)
			{
			}else{
			while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
			{
			$mahs=$row['mahs'];
			$rr = mysqli_query($con,"SELECT * FROM hoso_nguoitimviec WHERE mahs = '$mahs'");
			$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
			$uid=$rows['unique_id'];
			if($gioitinh=="")
			{
				$rrr=mysqli_query($con,"SELECT * FROM chitiet_nguoitimviec WHERE unique_id = '$uid'");
				$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
				$bd = $rowss['ngaysinh'];
				$bits = explode('/', $bd);
				$age = date('Y') - $bits[0];
				if($tuoi!="")
				{
					$bi = explode('-', $tuoi);
					if($age>$bi[0] AND $age < $bi[1])
					{
						$sss = mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$uid'");
						$raws = mysqli_fetch_array($sss, MYSQL_ASSOC);
						$img=$raws['photo'];
						array_push($mang, new hoso($row["tentruong"],$row["chuyennganh"],$row["xeploai"],$row["thanhtuu"],$row["namkn"],$row["tencongty"],$row["chucdanh"],$row["motacv"],$row["ngoaingu"],$row["kynang"],$row["tencv"],$row["nganhnghe"],$row["vitri"],$row["mucluong"],$row["diadiem"],$row["createdate"],$mahs,$rowss["hoten"],$rowss["gioitinh"],$rowss["ngaysinh"],$rowss["email"],$rowss["sdt"],$rowss["diachi"],$rowss["quequan"],$img));
					}
				}else{
						$sss = mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$uid'");
						$raws = mysqli_fetch_array($sss, MYSQL_ASSOC);
						$img=$raws['photo'];
						array_push($mang, new hoso($row["tentruong"],$row["chuyennganh"],$row["xeploai"],$row["thanhtuu"],$row["namkn"],$row["tencongty"],$row["chucdanh"],$row["motacv"],$row["ngoaingu"],$row["kynang"],$row["tencv"],$row["nganhnghe"],$row["vitri"],$row["mucluong"],$row["diadiem"],$row["createdate"],$mahs,$rowss["hoten"],$rowss["gioitinh"],$rowss["ngaysinh"],$rowss["email"],$rowss["sdt"],$rowss["diachi"],$rowss["quequan"],$img));
					
					}
			}else {
				$rrr=mysqli_query($con,"SELECT * FROM chitiet_nguoitimviec WHERE unique_id = '$uid' AND gioitinh = '$gioitinh'");
					if(mysqli_num_rows($rrr)>0)
					{		
						$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
						$bd = $rowss['ngaysinh'];
						$bits = explode('/', $bd);
						$age = date('Y') - $bits[0];
						if($tuoi!="")
						{
							$bi = explode('-', $tuoi);
							if($age>$bi[0] AND $age < $bi[1])
							{
								$sss = mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$uid'");
								$raws = mysqli_fetch_array($sss, MYSQL_ASSOC);
								$img=$raws['photo'];
								array_push($mang, new hoso($row["tentruong"],$row["chuyennganh"],$row["xeploai"],$row["thanhtuu"],$row["namkn"],$row["tencongty"],$row["chucdanh"],$row["motacv"],$row["ngoaingu"],$row["kynang"],$row["tencv"],$row["nganhnghe"],$row["vitri"],$row["mucluong"],$row["diadiem"],$row["createdate"],$mahs,$rowss["hoten"],$rowss["gioitinh"],$rowss["ngaysinh"],$rowss["email"],$rowss["sdt"],$rowss["diachi"],$rowss["quequan"],$img));
							}
						}else{
								$sss = mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$uid'");
								$raws = mysqli_fetch_array($sss, MYSQL_ASSOC);
								$img=$raws['photo'];
								array_push($mang, new hoso($row["tentruong"],$row["chuyennganh"],$row["xeploai"],$row["thanhtuu"],$row["namkn"],$row["tencongty"],$row["chucdanh"],$row["motacv"],$row["ngoaingu"],$row["kynang"],$row["tencv"],$row["nganhnghe"],$row["vitri"],$row["mucluong"],$row["diadiem"],$row["createdate"],$mahs,$rowss["hoten"],$rowss["gioitinh"],$rowss["ngaysinh"],$rowss["email"],$rowss["sdt"],$rowss["diachi"],$rowss["quequan"],$img));
							
							}
					}
				}
			}
		}	
		}
			 mysqli_close($con);
		echo json_encode($mang);
		} 
	
	
	  
class hoso{
	var $nganhnghe;
	var $vitri;
	var $mucluong;
	var $diadiem;
	var $createdate;
	var $mahs;
	var $tentruong;
	var $chuyennganh;
	var $xeploai;
	var $thanhtuu;
	var $namkn;
	var $tencongty;
	var $chucdanh;
	var $mota;
	var $ngoaingu;
	var $kynang;
	var $tencv;
	var $hoten;
	var $gioitinh2;
	var $ngaysinh;
	var $email;
	var $sdt;
	var $diachi;
	var $quequan;
	var $img;
	function hoso($tentruong,$chuyennganh,$xeploai,$thanhtuu,$namkn,$tencongty,$chucdanh,$mota,$ngoaingu,$kynang,$tencv,$nganhnghe,$vitri,$mucluong,$diadiem,$createdate,$mahs,$hoten,$gioitinh2,$ngaysinh,$email,$sdt,$diachi,$quequan,$img){
		$this->img=$img;
		$this->nganhnghe=$nganhnghe;
		$this->vitri=$vitri;
		$this->mucluong=$mucluong;
		$this->diadiem=$diadiem;
		$this->createdate=$createdate;
		$this->mahs=$mahs;
		$this->tentruong=$tentruong;
		$this->chuyennganh=$chuyennganh;
		$this->xeploai=$xeploai;
		$this->thanhtuu=$thanhtuu;
		$this->namkn=$namkn;
		$this->tencongty=$tencongty;
		$this->chucdanh=$chucdanh;
		$this->mota=$mota;
		$this->ngoaingu=$ngoaingu;
		$this->kynang=$kynang;
		$this->tencv=$tencv;
		$this->hoten=$hoten;
		$this->gioitinh2=$gioitinh2;
		$this->ngaysinh=$ngaysinh;
		$this->email=$email;
		$this->sdt=$sdt;
		$this->diachi=$diachi;
		$this->quequan=$quequan;
    }
}

