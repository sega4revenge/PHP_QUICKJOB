<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['macv']) ) {
 
    // receiving the post params
	$mahs = $_POST['id'];
	$macv = $_POST['macv'];
	$checkprofileaddjob=$db->CheckProfileAddJob($macv,$mahs);

	if($checkprofileaddjob == true)
	{
	$kq=0;
    	echo $kq; 
	}else{
		
		$nophoso =$db->nophoso($mahs,$macv);
		$nophoso2 =$db->nophoso_nhatuyendung($mahs,$macv);
		/*$token=$db->gettoken2($macv);
		$token2[]=$token;
		$message = "1";
		$message_status = send_notification($token2,$message);
		echo $message_status;*/
	$kq=1;
    	echo $kq; 
	}
		


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
			'Authorization:key = AIzaSyDoYr0fjLapge4GgqKKGH8nYtO1f4TV-44 ',
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

?>