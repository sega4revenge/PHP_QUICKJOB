<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['mahs'])) {
 
    // receiving the post params
	$id = $_POST['id'];
	$mahs = $_POST['mahs'];
	$response["error"] = false;
    $response["success"] =1;
    $response["msg"] = "Xóa thành công!";
	$xoacv =$db->deleteDataSaveProfile($id,$mahs);
	

    echo json_encode($response);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Xóa th?t b?i!";
    echo json_encode($response);
}

?>