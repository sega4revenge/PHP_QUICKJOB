<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);

if (isset($_POST['id']) && isset($_POST['token'])) {
	
    // receiving the post params
    $uid = $_POST['id'];
    $token = $_POST['token'];
	$checkdata=$db->checktoken($uid);
    if ($checkdata!=false) {
	if($token==$checkdata['id_token'])
	{
	$response["success"] =0;
        $response["error_msg"] = "Token already existed with" . $email;
	}else{
	 $update =$db->UpdateToken($uid,$token);
	}      	
        echo json_encode($response);
    } else {
	$user = $db->inserttoken($uid,$token);
	$response["success"] =1;
        $response["error_msg"] = "Thanh cong!";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
?>