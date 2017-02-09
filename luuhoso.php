<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['mahs']) ) {
 
    // receiving the post params
	$id = $_POST['id'];
	$mahs = $_POST['mahs'];
	$CheckProfileSave=$db->CheckProfileSave($id,$mahs);
	if($CheckProfileSave == true)
	{
    	echo "Hồ sơ này đã được lưu ."; 
	}else{
		$luuhs =$db->luuhs($id,$mahs);
    	echo "Lưu thành công"; 
	}	
 
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

?>