<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['namejop']) && isset($_POST['chucdanh']) && isset($_POST['mucluong']) && isset($_POST['diadiem']) && isset($_POST['motacongviec']) && isset($_POST['tuoiyeucau']) && isset($_POST['hocvan']) && isset($_POST['gioitinh'])&& isset($_POST['ngoaingu'])&& isset($_POST['kynang'])&& isset($_POST['yeucaukhac'])&& isset($_POST['tencongty'])&& isset($_POST['quymo'])&& isset($_POST['diachi'])&& isset($_POST['nganhnghe'])&& isset($_POST['gioithieucongty']) && isset($_POST['uid']) && isset($_POST['hannophoso']) && isset($_POST['soluong']) && isset($_POST['tennn'])) 
{
 
    // receiving the post params
  $namejop = $_POST['namejop'];
    $chucdanh = $_POST['chucdanh'];
    $mucluong = $_POST['mucluong'];
    $diadiem =$_POST['diadiem'];
    $motacongviec =$_POST['motacongviec'];
    $tuoiyeucau =$_POST['tuoiyeucau'];
    $hocvan =$_POST['hocvan'];
    $gioitinh =$_POST['gioitinh'];
    $ngoaingu =$_POST['ngoaingu'];
    $kynang =$_POST['kynang'];
    $yeucaukhac =$_POST['yeucaukhac'];
    $tencongty =$_POST['tencongty'];
    $quymo =$_POST['quymo'];
    $diachi =$_POST['diachi'];
    $nganhnghe =$_POST['nganhnghe'];
    $uid = $_POST['uid'];
    $gioithieucongty =$_POST['gioithieucongty'];
	$hannophoso =$_POST['hannophoso'];
	$nganhNghe =$_POST['tennn'];
	$soluong =$_POST['soluong'];
	$phucloi =$_POST['phucloi'];
	$macv =$_POST['macv'];
	$matd =$_POST['matd'];

   	$checkdata =$db->checkdata1($uid);  

	if($checkdata>0)
	{
		$chitietct = $db->update_nhatuyendung($uid,$tencongty,$quymo,$diachi,$nganhnghe,$gioithieucongty);
	}else{
		$chitietct = $db->chitiet_nhatuyendung($uid,$tencongty,$quymo,$diachi,$nganhnghe,$gioithieucongty);
	}
		
	$updatejob=$db->update_congviec($macv,$namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem,$motacongviec,$phucloi,$soluong,$hannophoso,$tuoiyeucau,$hocvan,$gioitinh,$ngoaingu,$yeucaukhac,$kynang);
	
	

	$response["success"] =1;

    echo json_encode($response);
  
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}


	


