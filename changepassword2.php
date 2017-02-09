<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['old']) || isset($_POST['new'])) {
 
    // receiving the post params
	$id = $_POST['id'];
	$old = $_POST['old'];
	$pass=$_POST['new'];
	$checkdata = $db->checkpassword($old,$id);
	if($checkdata)
	{
		$updatepass= $db->update_user2($pass,$id);
		$kq=1;
        echo $kq;
	}else{
		$response["error"] = true;
		$response["success"] =0;
		$response["error_msg"] = "Thay d?i th?t b?i!";
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