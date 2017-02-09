<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (true) {
 
    // receiving the post params
    $uniqueid = $_POST['uid'];
	$hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $birtdate = $_POST['birtdate'];
    $mail =$_POST['mail'];
    $sdt =$_POST['sdt'];
    $diachi =$_POST['diachi'];
    $quequan =$_POST['quequan'];
    $tentruong =$_POST['tentruong'];
    $chuyennganh =$_POST['chuyennganh'];
    $xeploai =$_POST['xeploai'];
    $thanhtuu =$_POST['thanhtuu'];
    $namkn =$_POST['namkn'];
    $tencongty =$_POST['tencongty'];
    $chucdanh =$_POST['chucdanh'];
    $motacv =$_POST['motacv'];
    $ngoaiNgu = $_POST['ngoaiNgu'];
    $kyNang =$_POST['kyNang'];
    $tencv=$_POST['tencv'];
    $nganhnghe =$_POST['nganhnghe'];
    $mucluong =$_POST['mucluong'];
    $vitri =$_POST['vitri'];
    $diadiem =$_POST['diadiem'];
	$mahs = $_POST['mahs'];
	$checkdata =$db->checkdata($uniqueid);  
	if($checkdata>0)
	{
		$nguoitimviec_chietiet	 =$db->update_nguoitimviec($uniqueid,$hoten,$gioitinh,$birtdate,$mail,$sdt,$diachi,$quequan);
	}else{
		$nguoitimviec_chietiet = $db->chitiet_nguoitmviec($uniqueid,$hoten,$gioitinh,$birtdate,$mail,$sdt,$diachi,$quequan);
	}
	$update_hoso =$db->update_hoso($mahs,$tentruong,$chuyennganh,$xeploai,$thanhtuu,$namkn,$tencongty,$chucdanh,$motacv,$ngoaiNgu,$kyNang,$tencv,$nganhnghe,$mucluong,$vitri,$diadiem);
	

    	$response["success"] =1;
	$response["msg"] ="S?a thành công";
	echo json_encode($response);
   

     
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

?>