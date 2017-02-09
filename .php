<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
if (true) {
 
    // receivin
	echo "qưeqwe"
	//$gettoken = $db-> gettoken($namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

?>