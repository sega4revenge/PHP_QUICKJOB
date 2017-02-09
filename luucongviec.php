<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
  
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['id']) || isset($_POST['macv']) ) {
 
    // receiving the post params
	$id = $_POST['id'];
	$macv = $_POST['macv'];
	$checksavejop=$db->CheckJobSave($id,$macv);
	if($checksavejop == true)
	{
	$kq=2;
    	echo $kq; 
	}else{
		$luucv =$db->luucv($id,$macv);
	$kq=3;
    	echo $kq; 
	}
	
	
	

     
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}

?>