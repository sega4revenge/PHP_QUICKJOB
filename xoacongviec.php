<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['listitem']) ) {
 
    // receiving the post params
	$id = $_POST['id'];
	$macv = $_POST['listitem'];

	$result = json_decode($macv);

	for($i=0;$i<count($result);$i++)
	{
	
		$xoacv =$db->deleteDataSaveJob($id,$result[$i]);

	}
	 $response["error"] = false;
	$response["success"] =1;
    $response["msg"] = "Xóa thành công!";
    echo json_encode($response); 
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Xóa thất bại!";
    echo json_encode($response);
}

?>