<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['type']) && isset($_POST['namecompany']) && isset($_POST['phone'])) {
 
    // receiving the post params
  
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $type ="1";
    $company =$_POST['namecompany'];
    $phone =$_POST['phone'];
    // check if user is already existed with the same email
    if ($db->isUserExisted($email)) {
        // user already existed
        $response["error"] = TRUE;
	$response["success"] = 0;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser1($email,$password,$type,$company,$phone);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
		$response["success"] =1;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
	    $response["success"] =0;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
?>