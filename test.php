<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(true) {
	  $id="579afc4d36a533.29862162";
	
	 
       $qr="SELECT * FROM users WHERE unique_id = '$id'";
	
        $r = mysqli_query($con, $qr);
		$rows = mysqli_fetch_array($r, MYSQL_ASSOC);
		array_push($mang,new user($rows["name"],$rows["email"],$rows["type"]));
		 mysqli_close($con);
		echo json_encode($mang);
		} 
class user{
	var $name;
	var $email;
	var $type;
	function user($name,$email,$type){
		$this->name=$name;
		$this->email=$email;
		$this->type=$type;
    }
}