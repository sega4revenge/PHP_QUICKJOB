<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['macv']) ) {
 
    // receiving the post params
	$id = $_POST['id'];
	$macv = $_POST['macv'];
	$matd =$db->takematd($macv);
	$xoajob =$db->deleteDataJob($id,$matd);
	$xoajob2 =$db->deleteDataJob2($id,$macv);
	$response["error"] = false;
	$response["success"] =1;
    $response["msg"] = "XÃ³a thÃ nh cÃ´ng";
    echo json_encode($response);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "XÃ³a tháº¥t báº¡i!";
    echo json_encode($response);
}

?>