<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['email']) || isset($_POST['mk'])) {
 
    // receiving the post params
	$email = $_POST['email'];
	$pass = $_POST['mk'];
	$checkdata = $db->update_user($email,$pass);
	$response["error"] = FALSE;
    $response["success"] =1;
    $response["error_msg"] = "Thay đổi thành công!";
    echo json_encode($response);
	//$delete = $db->deleteData($mahs,$macv);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

?>