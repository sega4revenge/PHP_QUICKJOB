<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['mahs']) ) {
 
    // receiving the post params
	$id = $_POST['id'];
	$mahs = $_POST['mahs'];
	
	$xoahs =$db->deleteDataProfile($id,$mahs);
	$xoahsf =$db->deleteDataProfile_Detail($mahs);
	$xoahsd =$db->deleteDataProfile_Company($mahs);
	$xoahsd =$db->deleteProfile($mahs);
	$response["error"] = false;
	$response["success"] =1;
    $response["msg"] = "Xóa thành công";
    echo json_encode($response);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Xóa thất bại!";
    echo json_encode($response);
}

?>