<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['namejop']) && isset($_POST['chucdanh']) && isset($_POST['mucluong']) && isset($_POST['diadiem']) && isset($_POST['motacongviec']) && isset($_POST['tuoiyeucau']) && isset($_POST['hocvan']) && isset($_POST['gioitinh'])&& isset($_POST['ngoaingu'])&& isset($_POST['kynang'])&& isset($_POST['yeucaukhac'])&& isset($_POST['tencongty'])&& isset($_POST['quymo'])&& isset($_POST['diachi'])&& isset($_POST['nganhnghe'])&& isset($_POST['gioithieucongty']) && isset($_POST['uid']) && isset($_POST['hannophoso']) && isset($_POST['soluong']) && isset($_POST['tennn']) && isset($_POST['latitude']) && isset($_POST['longitude'])) 
{
 
    // receiving the post params
    $lat =$_POST['latitude'];
    $lng =$_POST['longitude'];
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
   	$uuid = $db->taotintuyendung($uid);
	$checkdata =$db->checkdata1($uid);  

	if($checkdata>0)
	{
		$chitietct = $db->update_nhatuyendung($uid,$tencongty,$quymo,$diachi,$nganhnghe,$gioithieucongty);
	}else{
		$chitietct = $db->chitiet_nhatuyendung($uid,$tencongty,$quymo,$diachi,$nganhnghe,$gioithieucongty);
	}
	$create=$db->taocongviec($uuid,$namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem,$motacongviec,$phucloi,$soluong,$hannophoso,$tuoiyeucau,$hocvan,$gioitinh,$ngoaingu,$yeucaukhac,$kynang);
	$createlocation=$db->location($create,$lat,$lng);
	$gettoken =$db->gettoken($namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem);
	$getinformation =$db->getinformation($namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem);
		while($row = mysqli_fetch_array($gettoken, MYSQL_ASSOC))
		{	
		//	$tokens = new array();
			//echo $row['id_token'];
			$tokens[]= $row['id_token'];		
			
		}
		while($rows = mysqli_fetch_array($getinformation, MYSQL_ASSOC))
		{			
			$setnotification= $db->SetNotification($rows['unique_id'],$create);
		}
		//echo json_encode($tokens);
		$message = "Da tim thay 1 cong viec phu hop voi ban.";
		$message_status = send_notification($tokens,$message);
		//echo $message_status;
		$response["success"] =1;
		$response["error_msg"] = "Tao thanh cong!";
    echo json_encode($response);
  
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
				$fields = array(
			 'registration_ids' => $tokens,
			"notification" => array(
			"body" => $message,
			"title" => "QUICKJOB Thong bao:"
			)
			);
		$headers = array(
			'Authorization:key = AIzaSyD-65l9tiEycOMYGGPPEr_owLQiQ1HcXRk',
			'Content-Type: application/json'
			);
	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}
	


