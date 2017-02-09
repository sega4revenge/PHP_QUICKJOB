<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['macv'])) {
	  $macv=$_POST['macv'];
      $qr="SELECT * FROM hoso_ungtuyen_chonloc WHERE macv LIKE '$macv'";
	
        $r = mysqli_query($con, $qr);
		while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
		{
			$mahs=$row['mahs'];
			$rr = mysqli_query($con,"SELECT * FROM chitiet_hoso WHERE mahs = '$mahs'");
			$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
			$rrr = mysqli_query($con,"SELECT * FROM hoso_nguoitimviec WHERE mahs = '$mahs'");
			$rowsss = mysqli_fetch_array($rrr, MYSQL_ASSOC);
			$uid=$rowsss['unique_id'];
			$sss = mysqli_query($con,"SELECT * FROM volleyupload WHERE name = '$uid'");
			$raws = mysqli_fetch_array($sss, MYSQL_ASSOC);
			$img=$raws['photo'];
			$rrr=mysqli_query($con,"SELECT * FROM chitiet_nguoitimviec WHERE unique_id = '$uid'");
			$rowss=mysqli_fetch_array($rrr, MYSQL_ASSOC);
			array_push($mang, new hoso($rows["tentruong"],$rows["chuyennganh"],$rows["xeploai"],$rows["thanhtuu"],$rows["namkn"],$rows["tencongty"],$rows["chucdanh"],$rows["motacv"],$rows["ngoaingu"],$rows["kynang"],$rows["tencv"],$rows["nganhnghe"],$rows["vitri"],$rows["mucluong"],$rows["diadiem"],$rows["createdate"],$mahs,$rowss["hoten"],$rowss["gioitinh"],$rowss["ngaysinh"],$rowss["email"],$rowss["sdt"],$rowss["diachi"],$rowss["quequan"],$img));
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