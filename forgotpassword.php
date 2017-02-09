<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['email'])) {
 
    // receiving the post params
	$email = $_POST['email'];
	
	$checkdata = $db->isUserExisted($email);
	if($checkdata)
	{
		$response["error"] = FALSE;
		$response["success"] =1;
		$response["error_msg"] = "Waiting...";
		echo json_encode($response);
	}else{
		$response["error"] = TRUE;
		$response["success"] =0;
		$response["error_msg"] = "Email chưa được đăng ký";
		echo json_encode($response);
		
	}

	//$delete = $db->deleteData($mahs,$macv);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

?>