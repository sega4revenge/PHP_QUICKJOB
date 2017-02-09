<?php
	define('HOST','localhost');
	define('USER','quickjobgaa1bb');
	define('PASS','7c066c0f70c94c23');
	define('DB','quickjob_ga_a1bb');
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('unable to connect to db');
	if(isset($_POST['image']) || isset($_POST['name'])){
		
		$image = $_POST['image'];
        	$name = $_POST['name'];
		$now = DateTime::createFromFormat('U.u', microtime(true));
    		$id = $now->format('YmdHisu');

		$result1="SELECT * FROM volleyupload WHERE name = '$name'";
		$query1= mysqli_query($con,$result1);
		$ct1 = mysqli_num_rows($query1);
		if($ct1>0)
		{
			
			 $bob = mysqli_fetch_array($query1, MYSQL_ASSOC);
			 $arrimg = explode("/",$bob['photo']);
			 $path1="image/$arrimg[4]";
			 echo $path1; 
   			 unlink($path1); 		
		}

		$path = "image/$id.png";
		$actualpath = "http://quickjob.ga/$path";
		$result="SELECT name FROM volleyupload WHERE name = '$name'";
		$query= mysqli_query($con,$result);
		$ct = mysqli_num_rows($query);		
		if($ct>0)
		{
			$sql = "UPDATE volleyupload SET photo = '$actualpath' WHERE name = '$name'";	
			if(mysqli_query($con,$sql)){
			file_put_contents($path,base64_decode($image));
			echo $actualpath;
		}
		}else{
			
			$sql = "INSERT INTO volleyupload (photo,name) VALUES ('$actualpath','$name')";
			if(mysqli_query($con,$sql)){
				file_put_contents($path,base64_decode($image));
				echo $actualpath;
			}
		} 
		mysqli_close($con);
	}else{
		echo "Error";
	}