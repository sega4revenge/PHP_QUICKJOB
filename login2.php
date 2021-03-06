
<?php

require_once 'include/DB_Functions.php';

$db = new DB_Functions();


// json response array

$response = array("error" => FALSE);


if (isset($_POST['email']) && isset($_POST['password'])) 
{

    // receiving the post params
    
	$email = $_POST['email'];
    
	$password = $_POST['password'];

    
	// get the user by email and password
    
	$user = $db->getUserByEmailAndPassword1($email, $password);

    
	if ($user != false) {
        
	// use is found
        
 			$response["error"] = FALSE;
 			$response["success"] =1;   
			$response["objectname"] =$user["name"];  
			$response["mtype"] =$user["type"]; 
			$response["company"] =$user["namecompany"]; 
 			$response["uid"] = $user["unique_id"];
			$response["dt"] = $user["phone"];
			$id=$user["unique_id"];
			$response["status"]=0;
 			if($user["type"]==0){
				$check = $db->checkdata1($id);
				if($check>0)
				{
				$img = $db->getchitiet_logo($id);
				$response["logo"]=$img['photo'];
				$response["status"]=1;
				
				}
				
			}else {
				$check = $db->checkdata($id);
				if($check>0)
				{
				
				$img = $db->getchitiet_logo($id);
				$response["logo"]=$img['photo'];
				$response["status"]=1;
				}
			}

 		     
			echo json_encode($response);
    
	} else {
       
 		// user is not found with the credentials
        
			$response["success"] = 0;
  
			$response["error"] = TRUE;
        
			$response["error_msg"] = "Login credentials are wrong. Please try again!";
        
			echo json_encode($response);
    
	}

} else {
    
// required post params is missing
    
			$response["success"] = 0;
  
			$response["error"] = TRUE;
    
			$response["error_msg"] = "Required parameters email or password is missing!";
    
			echo json_encode($response);

}


?>


