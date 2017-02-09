<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['mahs']) || isset($_POST['macv']) || isset($_POST['status'])  ) {
 
    // receiving the post params
	$mahs = $_POST['mahs'];
	$macv = $_POST['macv'];
	$status = $_POST['status'];
	if($status=="0")
	{
		$inset = $db->UpdateData($mahs,$macv);
		$inset2 = $db->UpdateData_nguoitimviec($mahs,$macv);
		
 
		
	}else{
		$inset = $db->UpdateData2($mahs,$macv);	
		$inset2 = $db->UpdateData_nguoitimviec2($mahs,$macv);
   
	}
		$response["error"] = FALSE;
		$response["success"] =1;
		echo json_encode($response);
	//$delete = $db->deleteData($mahs,$macv);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

?>