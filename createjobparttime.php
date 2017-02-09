<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
if (isset($_POST['namejob']) && isset($_POST['mucluong']) && isset($_POST['diadiem']) && isset($_POST['motacongviec']) && isset($_POST['tencongty']) && isset($_POST['nganhnghe']) && isset($_POST['id']) && isset($_POST['latitude']) && isset($_POST['longitude'])  && isset($_POST['numberapply']) && isset($_POST['limitapply']) && isset($_POST['bangcap'])) 
{
 
    $bangcap=$_POST['bangcap'];
    $limit =$_POST['limitapply'];
    $num =$_POST['numberapply'];
    $lat =$_POST['latitude'];
    $lng =$_POST['longitude'];
    $namejop = $_POST['namejob'];
    $mucluong = $_POST['mucluong'];
    $diadiem =$_POST['diadiem'];
    $motacongviec =$_POST['motacongviec'];
    $tencongty =$_POST['tencongty'];
    $nganhNghe =$_POST['nganhnghe'];
    $uid = $_POST['id'];
    $khac = $_POST['yeucaukhac'];
   	$uuid = $db->taotintuyendung($uid);
	$checkdata =$db->checkdata1($uid);  
	if($checkdata>0)
	{
		
	}else{
		$chitietct = $db->chitiet_nhatuyendung($uid,$tencongty,"","","","");
	}
	$create=$db->taocongviec($uuid,$namejop,$nganhNghe,$bangcap,$mucluong,$diadiem,$motacongviec,"",$num,$limit,"","","","",$khac,"");
	$createlocation=$db->location($create,$lat,$lng);
	$gettoken =$db->gettoken($namejop,$nganhNghe,$bangcap,$mucluong,$diadiem);
	$getinformation =$db->getinformation($namejop,$nganhNghe,$bangcap,$mucluong,$diadiem);
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

    echo 1;
  
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
	


